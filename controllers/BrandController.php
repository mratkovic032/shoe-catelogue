<?php
    namespace App\Controllers;

    use App\Models\CategoryModel;
    use App\Models\ProductModel;
    use App\Models\BrandModel;
    use App\Core\Controller;

    class BrandController extends Controller {        
        
        public function show($categoryId, $brandId) {
            $brandModel = new BrandModel($this->getDatabaseConnection());    
            $brand = $brandModel->getById($brandId);
            if (!$brand) {
                $this->redirect(\Configuration::BASE);
            }
            $this->set('brand', $brand);  

            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId); 
            if (!$category) {
                $this->redirect(\Configuration::BASE);
            }           
            $this->set('category', $category);
            
            $productModel = new ProductModel($this->getDatabaseConnection());
            $products = $productModel->getAllByCategoryIdAndBrandId($categoryId, $brandId);

            $this->set('products', $products);          
        }

        public function brands() {
            $brandModel = new BrandModel($this->getDatabaseConnection());    
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);
        }

        public function brandProducts(int $brandId) {
            $brandModel = new BrandModel($this->getDatabaseConnection());    
            $products = $brandModel->getProductsByBrandId($brandId);
            $this->set('products', $products);
        }
    }