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
        
        public function filter() {    
            $productModel = new ProductModel($this->getDatabaseConnection());

            $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);    
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING);  
            $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            $sql = 'SELECT DISTINCT product.product_id, product.title, product.description FROM 
            (((product INNER JOIN brand ON product.brand_id = brand.brand_id) INNER JOIN category ON product.category_id = category.category_id) INNER JOIN admin ON product.admin_id = admin.admin_id) INNER JOIN 
            ((product_version INNER JOIN color ON product_version.color_id = color.color_id) INNER JOIN size ON product_version.size_id = size.size_id) ON product.product_id = product_version.product_id WHERE ';

            $conditions = [];

            if ($material !== "") {
                $conditions[] = "material LIKE '$material'";
            }

            if ($category !== "") {
                $conditions[] = "category.name = '$category'";
            }

            if ($brand !== "") {
                $conditions[] = "brand.name = '$brand'";
            }

            if ($color !== "") {
                $conditions[] = "color.name = '$color'";
            }

            if ($size !== "") {
                $conditions[] = "size.value = '$size'";
            }

            $sql .= implode(" AND ", $conditions) . ";";
            // var_dump($sql);         

            $products = $productModel->getAllByFilter($sql);
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
