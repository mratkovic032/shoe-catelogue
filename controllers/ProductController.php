<?php
    namespace App\Controllers;
    
    use App\Models\ProductModel;
    use App\Models\ProductVersionModel;
    use App\Models\ProductViewModel;
    use App\Core\Controller;

    class ProductController extends Controller {        
        
        public function show($id) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($id);
            if (!$product) {
                $this->redirect(\Configuration::BASE);
                exit;
            }
            $this->set('product', $product);

            $productsInStock = $this->productsInStock($id);
            $this->set('productsInStock', $productsInStock);

            $productViewModel = new ProductViewModel($this->getDatabaseConnection());

            $ipAddress = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
            $userAgent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

            $productViewModel->add(
                [
                    'product_id' => $id,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent
                ]
            );
        }

        private function productsInStock($id) {
            $productVersionModel = new ProductVersionModel($this->getDatabaseConnection());
            $productVersions = $productVersionModel->getAllByProductId($id);

            $productsInStock = [];
            foreach ($productVersions as $product) {
                if ($product->quantity > 0) {
                    array_push($productsInStock, $product);
                }
            }

            return $productsInStock;
        }                
    }