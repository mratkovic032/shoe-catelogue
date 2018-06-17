<?php
    namespace App\Controllers;

    use App\Models\CategoryModel;
    use App\Models\ProductModel;
    use App\Core\Controller;

    class CategoryController extends Controller {        
        
        public function show($id) {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id); 
            if (!$category) {
                $this->redirect(\Configuration::BASE);
            }           
            $this->set('category', $category);

            $productModel = new ProductModel($this->getDatabaseConnection());
            $productsInCategory = $productModel->getAllByCategoryId($id);
            $this->set('productsInCategory', $productsInCategory);
        }
    }