<?php
    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\ProductModel;
    use App\Models\ImageModel;

    class SearchController extends Controller {

        private function normalizeKeywords(string $keywords):string {
            $keywords = trim($keywords);
            $keywords = preg_replace('/ +/', ' ', $keywords);
            # ...
            return $keywords;
        }
        
        public function quickSearch() {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);            
        
            $products = $productModel->getAllByKeyword($this->normalizeKeywords($search));
            
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
