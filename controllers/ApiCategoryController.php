<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\CategoryModel;

    class ApiCategoryController extends ApiController {

        public function getCategories() {
            $category = $this->getSession()->get('category', []);
            $this->set('category', $category);
        }

        public function addCategory(string $newCategory) {                   
            $categoryModel = new CategoryModel($this->getDatabaseConnection());

            $category = $categoryModel->getByFieldName('name', $newCategory);
            if ($category) {
                $this->set('message', 'Doslo je do greske: Vec postoji takva kategorija.');
                return;
            }
            
            $categoryId = $categoryModel->add([ 
                'name' => $newCategory
            ]);

            $category[] = $categoryModel->getLastEnteredId();
            $this->getSession()->put('category', $category);

            $this->set('error', 0);
            return;
        }

        public function clear() {
            $this->getSession()->put('category', []);
            $this->set('error', 0);
        }
    }