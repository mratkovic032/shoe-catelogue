<?php
    namespace App\Controllers;

    use App\Models\CategoryModel;
    use App\Core\Controller;
    use App\Validators\StringValidator;
    use App\Models\AdminModel;

    class MainController extends Controller {        
        
        public function home() {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();            
            $this->set('categories', $categories);

            // $this->getSession()->put('some_key', 'some_value_' . rand(100, 999));

            $oldValue = $this->getSession()->get('counter', 0);
            $newValue = $oldValue + 1;            
            $this->getSession()->put('counter', $newValue);

            $this->set('sessionData', $newValue);
        }    
        
        public function getRegister() {

        }

        public function postRegister() {
            $email = filter_input(INPUT_POST, 'reg_email', FILTER_SANITIZE_EMAIL);
            $username = filter_input(INPUT_POST, 'reg_username', FILTER_SANITIZE_STRING);
            $password1 = filter_input(INPUT_POST, 'reg_password_1', FILTER_SANITIZE_STRING);
            $password2 = filter_input(INPUT_POST, 'reg_password_2', FILTER_SANITIZE_STRING);

            if ($password1 !== $password2) {
                $this->set('message', 'Doslo je do greske: Lozinke moraju biti iste.');
                return;
            }
            
            if (!(new StringValidator())->setMinLength(7)->setMaxLength(120)->isValid($password1)) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $adminModel = new AdminModel($this->getDatabaseConnection());
            $admin = $adminModel->getByFieldName('email', $email);
            if ($admin) {
                $this->set('message', 'Doslo je do greske: Vec postoji korisnik sa tim email-om.');
                return;
            }

            $admin = $adminModel->getByFieldName('username', $username);
            if ($admin) {
                $this->set('message', 'Doslo je do greske: Vec postoji korisnik sa tim korisnickim imenom.');
                return;
            }

            $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

            $userId = $adminModel->add([
                'username' => $username,
                'email' => $email,
                'password_hash' => $passwordHash
            ]);

            if (!$userId) {
                $this->set('message', 'Doslo je do greske: Nalog nije uspesno registrovan.');
                return;
            }

            $this->set('message', 'Napravljen je novi nalog. Sada mozete da se prijavite!');
        }

        public function getLogin() {

        }

        public function postLogin() {
            $username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            if (!(new StringValidator())->setMinLength(7)->setMaxLength(120)->isValid($password)) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $adminModel = new AdminModel($this->getDatabaseConnection());
            $admin = $adminModel->getByFieldName('username', $username);
            if (!$admin) {
                $this->set('message', 'Doslo je do greske: Ne postoji korisnik sa tim korisnickim imenom.');
                return;
            }

            if (!password_verify($password, $admin->password_hash)) {
                sleep(1);
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravna.');
                return;
            }

            $this->getSession()->put('admin_id', $admin->admin_id);
            $this->getSession()->save();
            
            $this->redirect(\Configuration::BASE . 'admin/dashboard');
        }
    }