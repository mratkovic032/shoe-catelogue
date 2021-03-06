<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\ProductModel;

    class ApiProductController extends ApiController {

        public function show($id) {
            $productModel = new ProductModel($this->getDatabaseConnection());
            $product = $productModel->getById($id);
            $this->set('product', $product);
        }
    }