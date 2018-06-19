<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\ColorModel;


    class AdminColorMenagementController extends AdminRoleController {
        public function colors() {
            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colors = $colorModel->getAll();            
            $this->set('colors', $colors);
        }

        public function getEdit($colorId) {
            $colorModel = new ColorModel($this->getDatabaseConnection());
            $color = $colorModel->getById($colorId);
            if (!$color) {
                $this->redirect(\Configuration::BASE . 'admin/colors');
            }

            $this->set('color', $color);
            return $colorModel;
        }

        public function postEdit($colorId) {
            $colorModel = $this->getEdit($colorId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $colorModel->editById($colorId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/colors');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colorId = $colorModel->add([ 
                'name' => $name
            ]);

            if ($colorId) {
                $this->redirect(\Configuration::BASE . 'admin/colors');
            }

            $this->set('message', 'Nije uspesno dodata boja');
        }

        public function delete(int $sizeId) {
            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colorModel->deleteById($sizeId);

            $this->redirect(\Configuration::BASE . 'admin/colors');
        }
    }
