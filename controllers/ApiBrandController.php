<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\BrandModel;

    class ApiBrandController extends ApiController {

        public function getBrands() {
            $brand = $this->getSession()->get('brand', []);
            $this->set('brand', $brand);
        }

        public function addBrand(string $newBrand) {                   
            $brandModel = new BrandModel($this->getDatabaseConnection());

            $brand = $brandModel->getByFieldName('name', $newBrand);
            if ($brand) {
                $this->set('message', 'Doslo je do greske: Vec postoji brend sa tim nazivom.');
                return;
            }
            
            $brandId = $brandModel->add([ 
                'name' => $newBrand
            ]);

            $brand[] = $brandModel->getLastEnteredId();
            $this->getSession()->put('brand', $brand);

            $this->set('error', 0);
            return;
        }

        public function clear() {
            $this->getSession()->put('brand', []);
            $this->set('error', 0);
        }
    }