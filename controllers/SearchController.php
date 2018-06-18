<?php
    namespace App\Controllers;

    use App\Core\Controller;
    use App\Models\ProductModel;

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
        
            $products = $productModel->getAllBySearch($this->normalizeKeywords($search));            
            $this->set('products', $products);
        }    
    }
