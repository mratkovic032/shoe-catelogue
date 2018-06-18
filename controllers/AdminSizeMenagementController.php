<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\SizeModel;

    class AdminSizeMenagementController extends AdminRoleController {

        public function sizes() {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAll();            
            $this->set('sizes', $sizes);
        }

        public function getSizeEdit($sizeId) {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $size = $sizeModel->getById($sizeId);
            if (!$size) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('size', $size);
            return $sizeModel;
        }

        public function postSizeEdit($sizeId) {
            $sizeModel = $this->getSizeEdit($sizeId);

            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            $sizeModel->editById($sizeId, [
                'value' => $size
            ]);

            $this->redirect(\Configuration::BASE . 'admin/sizes');
        }

        public function getSizeAdd() {

        }

        public function postSizeAdd() {
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizeId = $sizeModel->add([ 
                'value' => $size
            ]);

            if ($sizeId) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('message', 'Nije uspesno dodata velicina');
        }
    }
