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

    class AdminBrandMenagementController extends AdminRoleController {
        public function brands() {
            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);
        }       

        public function getBrandEdit($brandId) {
            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brand = $brandModel->getById($brandId);
            if (!$brand) {
                $this->redirect(\Configuration::BASE . 'admin/brands');
            }

            $this->set('brand', $brand);
            return $brandModel;
        }

        public function postBrandEdit($brandId) {
            $brandModel = $this->getBrandEdit($brandId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $brandModel->editById($brandId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/brands');
        }

        public function getBrandAdd() {

        }

        public function postBrandAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brandId = $brandModel->add([ 
                'name' => $name
            ]);

            if ($brandId) {
                $this->redirect(\Configuration::BASE . 'admin/brands');
            }

            $this->set('message', 'Nije uspesno dodat brend');
        }
    }
