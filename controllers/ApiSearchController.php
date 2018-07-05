<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\ProductModel;
    use App\Models\ImageModel;

    class ApiSearchController extends ApiController {

        public function filter(string $category, string $brand, string $material, string $color, string $size) {    
            $productModel = new ProductModel($this->getDatabaseConnection());                                        

            $products = $productModel->getAllByFilter($category, $brand, $material, $color, $size);
            $imageModel = new ImageModel($this->getDatabaseConnection());
            foreach ($products as $product) {                
                $image = $imageModel->getImageByProductId($product->product_id);
                if ($image) {
                    $product->path = $image->path;
                }                
            }  

            $this->set('products', $products);
        }
    }