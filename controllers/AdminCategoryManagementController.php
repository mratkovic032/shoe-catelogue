<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\ProductModel;
    use App\Models\CategoryModel;
    use App\Models\BrandModel;
    use App\Models\ColorModel;
    use App\Models\SizeModel;
    use App\Models\AdminModel;
    use App\Models\ProductVersionModel;

    class AdminCategoryManagementController extends AdminRoleController {     
        public function categories() {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();            
            $this->set('categories', $categories);
        }    

        public function getEdit($categoryId) {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId);
            if (!$category) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }

            $this->set('category', $category);
            return $categoryModel;
        }

        public function postEdit($categoryId) {
            $categoryModel = $this->getEdit($categoryId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            if ($name === "") {
                $this->set('message', 'Doslo je do greske: Morate popuniti polje.');
                return;
            }

            $categoryModel->editById($categoryId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/categories');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            if ($name === "") {
                $this->set('message', 'Doslo je do greske: Morate popuniti polje.');
                return;
            }

            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categoryId = $categoryModel->add([ 
                'name' => $name
            ]);

            if ($categoryId) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }

            $this->set('message', 'Nije uspesno dodata kategorija');
        }
        
        public function delete(int $sizeId) {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categoryModel->deleteById($sizeId);

            $this->redirect(\Configuration::BASE . 'admin/categories');
        }
    }
