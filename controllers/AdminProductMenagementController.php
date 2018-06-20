<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\ProductModel;
    use App\Models\CategoryModel;
    use App\Models\ColorModel;
    use App\Models\SizeModel;
    use App\Models\BrandModel;
    use App\Models\ProductVersionModel;

    class AdminProductMenagementController extends AdminRoleController {
        public function products() {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $productsWithBrandAndCategory = $productModel->showProductsWithBrandAndCategory();
            $this->set('productsWithBrandAndCategory', $productsWithBrandAndCategory);
        } 

        public function stock(int $productId) {
            $brandtModel = new BrandModel($this->getDatabaseConnection());
            $brandTitle = $brandtModel->getBrandAndTitleByProductId($productId);            
            $this->set('brandTitle', $brandTitle);

            $productModel = new ProductModel($this->getDatabaseConnection());
            $stock = $productModel->showStockByProductId($productId);
            
            $this->set('stock', $stock);            
            $this->set('id', $productId);            
        }

        public function getProductAdd() {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);            
        }

        public function postProductAdd() {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = sprintf("%.2f", filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);    
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT);  
            $admin = $this->getSession()->get('admin_id'); 

            $productModel = new ProductModel($this->getDatabaseConnection());
            $productId = $productModel->add([ 
                'title'            => $title,  
                'description'      => $description,  
                'price'            => $price, 
                'material'         => $material,  
                'category_id'      => $category,
                'brand_id'         => $brand,
                'admin_id'         => $admin
            ]);

            if (!$productId) {
                $this->set('message', 'Nije uspesno dodat proizvod');
            }
            
            $uploadStatus = $this->doImageUpload('image', $productId);
            if (!$uploadStatus) {                
                return;
            }
                        
            $this->redirect(\Configuration::BASE . 'admin/products');                
        }

        public function getProductEdit($productId) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->showWholeProduct($productId);                               
            $this->set('product', $product);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);

            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            return $productModel;
        }

        public function postProductEdit($productId) {
            $productModel = $this->getProductEdit($productId);

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = sprintf("%.2f", filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);    
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT); 
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT);  

            $productModel->editById($productId, [
                'title'          => $title,  
                'description'    => $description,  
                'price'          => $price, 
                'material'       => $material,  
                'category_id'    => $category,
                'brand_id'       => $brand
            ]);

            $uploadStatus = $this->doImageUpload('image', $productId);
            if (!$uploadStatus) {                
                return;
            }

            $this->redirect(\Configuration::BASE . 'admin/products');
        }                        

        public function getStockAdd(int $productId) {
            $this->set('id', $productId);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brandTitle = $brandModel->getBrandAndTitleByProductId($productId);
            $this->set('brandTitle', $brandTitle);            

            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->showWholeProduct($productId);
            $this->set('product', $product);

            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colors = $colorModel->getAll();
            $this->set('colors', $colors);

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAll();
            $this->set('sizes', $sizes);
        }

        public function postStockAdd(int $productId) {            
            $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_NUMBER_INT);
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);            
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);


            $productVersionModel = new ProductVersionModel($this->getDatabaseConnection());
            $productVersionId = $productVersionModel->add([ 
                'product_id'    => $productId,
                'color_id'      => $color,
                'size_id'       => $size,
                'quantity'      => $quantity
            ]);

            if ($productVersionId) {
                $this->redirect(\Configuration::BASE . 'admin/products/stock/' . $productId);
            }

            $this->set('message', 'Nije uspesno dodato stanje proizvoda');
        }

        public function getStockEdit($productVersionId) {
            $productVersionModel = new ProductVersionModel($this->getDatabaseConnection());
            $productVersion = $productVersionModel->showProductVersion($productVersionId);
            if (!$productVersion) {
                $this->redirect(\Configuration::BASE . 'admin/products');
            }            
            $this->set('productVersion', $productVersion);

            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colors = $colorModel->getAll();
            $this->set('colors', $colors);

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAll();
            $this->set('sizes', $sizes);

            return $productVersionModel;
        }

        public function postStockEdit($productVersionId) {
            $productVersionModel = $this->getStockEdit($productVersionId);
            
            $product = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
            $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_NUMBER_INT);
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);            
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
                
            $productVersionModel = new ProductVersionModel($this->getDatabaseConnection());
            $productVersionModel->editById($productVersionId, [
                'color_id'      => $color,
                'size_id'       => $size,
                'quantity'      => $quantity
            ]);   

            $this->redirect(\Configuration::BASE . 'admin/products/stock/' . $product);
        }

        public function deleteStock(int $productId, int $productVersionId) {
            $productVersionModel = new ProductVersionModel($this->getDatabaseConnection());
            $productVersionModel->deleteById($productVersionId);

            $this->redirect(\Configuration::BASE . 'admin/products/stock/' . $productId);
        }

        private function doImageUpload(string $fieldName, string $fileName): bool {
            $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
            $file = new \Upload\File($fieldName, $uploadPath);
            $file->setName($fileName);
            $file->addValidations([
                new \Upload\Validation\Mimetype("image/jpeg"),
                new \Upload\Validation\Size("3M")
            ]);

            try {
                $file->upload();
                return true;
            } catch (Exception $e) {
                $this->set('message', 'Greska: ' . implode(', ', $file->getErrors()));
                return false;
            }
        }
    }
