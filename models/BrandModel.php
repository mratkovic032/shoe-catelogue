<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;

    class BrandModel extends Model {

        protected function getFields(): array {
            return [
                'brand_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at'    => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),

                'name'          => new Field((new StringValidator())->setMaxLength(64))                
            ];
        }
        
        public function getBrandsByCategoryId(int $categoryId): array {
            $sql = 'SELECT DISTINCT brand.* FROM 
                    brand INNER JOIN product ON  brand.brand_id = product.brand_id
                    WHERE product.category_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $categoryId ]);
            $brands = [];
            if ($res) {
                $brands = $prep->fetchAll(\PDO::FETCH_OBJ);
            }            
            return $brands;
        }

        public function getProductsByBrandId(int $brandId): array {
            $sql = 'SELECT product.*, brand.name AS "brand", brand.path_small, category.name AS "category", admin.username AS "admin" FROM 
                    (brand INNER JOIN (product INNER JOIN category ON product.category_id = category.category_id) ON brand.brand_id = product.brand_id) 
                    INNER JOIN admin ON product.admin_id = admin.admin_id
                    WHERE product.brand_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $brandId ]);
            $products = [];
            if ($res) {
                $products = $prep->fetchAll(\PDO::FETCH_OBJ);
            }            
            return $products;
        }

        public function getBrandAndTitleByProductId(int $productId) {
            $sql = 'SELECT brand.name, product.title, product.product_id FROM 
                    product INNER JOIN brand ON product.brand_id = brand.brand_id
                    WHERE product.product_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $productId ]);            
            $brandTitle = NULL;
            if ($res) {
                $brandTitle = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $brandTitle;
        }
    }