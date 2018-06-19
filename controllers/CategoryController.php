<?php
    namespace App\Controllers;

    use App\Models\CategoryModel;
    use App\Models\BrandModel;
    use App\Core\Controller;

    class CategoryController extends Controller {        
        
        public function show($id) {
            $categoryModel = new CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id); 
            if (!$category) {
                $this->redirect(\Configuration::BASE);
            }           
            $this->set('category', $category);

            $brandModel = new BrandModel($this->getDatabaseConnection());    
            $brands = $brandModel->getBrandsByCategoryId($id);
            $this->set('brands', $brands);            
        }
    }