<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\SizeModel;

    class ApiSizeController extends ApiController {

        public function getSizes() {
            $size = $this->getSession()->get('size', []);
            $this->set('size', $size);
        }

        public function addSize(int $newSize) {                   
            $sizeModel = new SizeModel($this->getDatabaseConnection());

            $size = $sizeModel->getByFieldName('value', $newSize);
            if ($size) {
                $this->set('message', 'Doslo je do greske: Vec postoji takva velicina.');
                return;
            }
            
            $sizeId = $sizeModel->add([ 
                'value' => $newSize
            ]);

            $size[] = $sizeModel->getLastSize();
            $this->getSession()->put('size', $size);

            $this->set('error', 0);
            return;
        }

        public function clear() {
            $this->getSession()->put('size', []);
            $this->set('error', 0);
        }
    }