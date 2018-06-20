<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\ColorModel;

    class ApiColorController extends ApiController {

        public function getColors() {
            $color = $this->getSession()->get('color', []);
            $this->set('color', $color);
        }

        public function addColor(string $newColor) {                   
            $colorModel = new ColorModel($this->getDatabaseConnection());

            $color = $colorModel->getByFieldName('name', $newColor);
            if ($color) {
                $this->set('message', 'Doslo je do greske: Vec postoji takva boja.');
                return;
            }
            
            $colorId = $colorModel->add([ 
                'name' => $newColor
            ]);

            $color[] = $colorModel->getLastEnteredId();
            $this->getSession()->put('color', $color);

            $this->set('error', 0);
            return;
        }

        public function clear() {
            $this->getSession()->put('color', []);
            $this->set('error', 0);
        }
    }