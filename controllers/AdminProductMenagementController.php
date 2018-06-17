<?php
    namespace App\Controllers;

    use App\Core\Role\AdminRoleController;
    use App\Models\ProductModel;
    use App\Models\CategoryModel;
    use App\Models\BrandModel;
    use App\Models\ColorModel;
    use App\Models\SizeModel;
    use App\Models\AdminModel;
    use App\Models\ProductVersionModel;

    class AdminProductMenagementController extends AdminRoleController {
        public function products() {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $productsWithBrandAndCategory = $productModel->showProductsWithBrandAndCategory();
            $this->set('productsWithBrandAndCategory', $productsWithBrandAndCategory);
        }        

        public function categories() {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();            
            $this->set('categories', $categories);
        }

        public function brands() {
            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);
        }

        public function colors() {
            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colors = $colorModel->getAll();            
            $this->set('colors', $colors);
        }

        public function sizes() {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAll();            
            $this->set('sizes', $sizes);
        }

        public function stock(int $productId) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $stock = $productModel->showStockByProductId($productId);
            
            if (!$stock) {
                $this->redirect(\Configuration::BASE . 'admin/products');
                exit;
            }
            
            $this->set('stock', $stock);            
            $this->set('id', $productId);
            $this->set('title', $stock[0]->brand . ' - ' . $stock[0]->title);
        }

        public function getProductEdit($productId) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->showWholeProduct($productId);
            if (!$product) {
                $this->redirect(\Configuration::BASE . 'admin/products');
            }            
            $this->set('product', $product);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAllExceptOne("name", $product->brand);
            $this->set('brands', $brands);

            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAllExceptOne("name", $product->category);
            $this->set('categories', $categories);

            $adminModel = new AdminModel($this->getDatabaseConnection());
            $admins = $adminModel->getAllExceptOne("username", $product->admin);
            $this->set('admins', $admins);

            return $productModel;
        }

        public function postProductEdit($productId) {
            $productModel = $this->getProductEdit($productId);

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);    
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT); 
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT); 
            $admin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT); 

            $productModel->editById($productId, [
                'title'          => $title,  
                'description'    => $description,  
                'price'          => $price, 
                'material'       => $material,  
                'category_id'    => $category,
                'brand_id'       => $brand,
                'admin_id'       => $admin
            ]);

            $this->redirect(\Configuration::BASE . 'admin/products');
        }

        public function getProductAdd() {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brands = $brandModel->getAll();
            $this->set('brands', $brands);            

            $adminModel = new AdminModel($this->getDatabaseConnection());
            $admins = $adminModel->getAll();
            $this->set('admins', $admins);
        }

        public function postProductAdd() {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);    
            $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT);  
            $admin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT); 


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

            if ($productId) {
                $this->redirect(\Configuration::BASE . 'admin/products/stock/add/' . $productId);                
            }

            $this->set('message', 'Nije uspesno dodat proizvod');
        }

        public function getCategoryEdit($categoryId) {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId);
            if (!$category) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }

            $this->set('category', $category);
            return $categoryModel;
        }

        public function postCategoryEdit($categoryId) {
            $categoryModel = $this->getCategoryEdit($categoryId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $categoryModel->editById($categoryId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/categories');
        }

        public function getCategoryAdd() {

        }

        public function postCategoryAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $categoryId = $categoryModel->add([ 
                'name' => $name
            ]);

            if ($categoryId) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }

            $this->set('message', 'Nije uspesno dodata kategorija');
        }

        public function getBrandEdit($brandId) {
            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brand = $brandModel->getById($brandId);
            if (!$brand) {
                $this->redirect(\Configuration::BASE . 'admin/brands');
            }

            $this->set('brand', $brand);
            return $brandModel;
        }

        public function postBrandEdit($brandId) {
            $brandModel = $this->getBrandEdit($brandId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $brandModel->editById($brandId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/brands');
        }

        public function getBrandAdd() {

        }

        public function postBrandAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $brandModel = new BrandModel($this->getDatabaseConnection());
            $brandId = $brandModel->add([ 
                'name' => $name
            ]);

            if ($brandId) {
                $this->redirect(\Configuration::BASE . 'admin/brands');
            }

            $this->set('message', 'Nije uspesno dodat brend');
        }

        public function getStockAdd(int $productId) {
            $this->set('id', $productId);

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
            $colors = $colorModel->getAllExceptOne("name", $productVersion->color);
            $this->set('colors', $colors);

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizes = $sizeModel->getAllExceptOne("value", $productVersion->size);
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

        public function getColorEdit($colorId) {
            $colorModel = new ColorModel($this->getDatabaseConnection());
            $color = $colorModel->getById($colorId);
            if (!$color) {
                $this->redirect(\Configuration::BASE . 'admin/colors');
            }

            $this->set('color', $color);
            return $colorModel;
        }

        public function postColorEdit($colorId) {
            $colorModel = $this->getColorEdit($colorId);

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $colorModel->editById($colorId, [
                'name' => $name
            ]);

            $this->redirect(\Configuration::BASE . 'admin/colors');
        }

        public function getColorAdd() {

        }

        public function postColorAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $colorModel = new ColorModel($this->getDatabaseConnection());
            $colorId = $colorModel->add([ 
                'name' => $name
            ]);

            if ($colorId) {
                $this->redirect(\Configuration::BASE . 'admin/colors');
            }

            $this->set('message', 'Nije uspesno dodata boja');
        }

        public function getSizeEdit($sizeId) {
            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $size = $sizeModel->getById($sizeId);
            if (!$size) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('size', $size);
            return $sizeModel;
        }

        public function postSizeEdit($sizeId) {
            $sizeModel = $this->getSizeEdit($sizeId);

            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            $sizeModel->editById($sizeId, [
                'value' => $size
            ]);

            $this->redirect(\Configuration::BASE . 'admin/sizes');
        }

        public function getSizeAdd() {

        }

        public function postSizeAdd() {
            $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);

            $sizeModel = new SizeModel($this->getDatabaseConnection());
            $sizeId = $sizeModel->add([ 
                'value' => $size
            ]);

            if ($sizeId) {
                $this->redirect(\Configuration::BASE . 'admin/sizes');
            }

            $this->set('message', 'Nije uspesno dodata velicina');
        }
    }
