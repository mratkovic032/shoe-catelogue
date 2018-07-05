<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\SizeModel;

    class AdminSizeManagementController extends AdminRoleController {

        public function sizes() {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAll();            
            $this->set('sizes', $sizes);
        }

        public function getEdit($sizeId) {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $size = $sizeModel->getById($sizeId);
            if (!$size) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('size', $size);
            return $sizeModel;
        }

        public function postEdit($sizeId) {
            $sizeModel = $this->getEdit($sizeId);

            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            if ($size < 16 || $size > 55) {
                $this->set('message', 'Doslo je do greske: Velicina mora biti vrednost izmedju 16 i 55.');
                return;
            }

            $sizeModel->editById($sizeId, [
                'value' => $size
            ]);

            $this->redirect(\Configuration::BASE . 'admin/sizes');
        }

        public function getAdd() {

        }

        public function postAdd() {
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            if ($size < 16 || $size > 55) {
                $this->set('message', 'Doslo je do greske: Velicina mora biti vrednost izmedju 16 i 55.');
                return;
            }

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizeId = $sizeModel->add([ 
                'value' => $size
            ]);

            if ($sizeId) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('message', 'Nije uspesno dodata velicina');
        }

        public function delete(int $sizeId) {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizeModel->deleteById($sizeId);

            $this->redirect(\Configuration::BASE . 'admin/sizes');
        }
    }
