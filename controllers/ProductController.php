<?php
    namespace App\Controllers;
    
    use App\Models\ProductModel;
    use App\Models\ProductVersionModel;
    use App\Models\ProductViewModel;
    use App\Models\BrandModel;
    use App\Models\ImageModel;
    use App\Core\Controller;

    class ProductController extends Controller {        
        
        public function show($id) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($id);
            if (!$product) {
                $this->redirect(\Configuration::BASE);
                exit;
            }

            $imageModel = new ImageModel($this->getDatabaseConnection());
            $image = $imageModel->getImageByProductId($product->product_id);

            $this->set('image', $image);
            $this->set('product', $product);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brand = $brandModel->getById($product->brand_id);
            $this->set('brand', $brand);

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

        public function products() {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $products = $productModel->showProductsWithBrandAndCategory();
            
            $imageModel = new ImageModel($this->getDatabaseConnection());
            foreach ($products as $product) {                
                $image = $imageModel->getImageByProductId($product->product_id);
                if ($image) {
                    $product->path = $image->path;
                }                
            }
            
            $this->set('products', $products);            
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