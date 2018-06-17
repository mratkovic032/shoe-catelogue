<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;

    class ProductVersionModel extends Model {

        protected function getFields(): array {
            return [
                'auction_version_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),
                
                'product_id'           => new Field((new NumberValidator())->setIntegerLength(10)),
                'color_id'             => new Field((new NumberValidator())->setIntegerLength(10)),
                'size_id'              => new Field((new NumberValidator())->setIntegerLength(10)),
                'quantity'             => new Field((new NumberValidator())->setIntegerLength(255))
            ];
        }
        
        public function getAllByProductId(int $productId): array {
            $sql = 'SELECT product_version.product_id, product_version.quantity, size.value AS "size", color.name AS "color" FROM 
                    size INNER JOIN (product_version INNER JOIN color ON product_version.color_id = color.color_id) 
                    ON size.size_id = product_version.size_id WHERE product_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $productId ]);
            $productVersions = [];
            if ($res) {
                $productVersions = $prep->fetchAll(\PDO::FETCH_OBJ);
            }            
            return $productVersions;
        }

        public function showProductVersion(int $productVersionId) {
            $sql = 'SELECT product_version.*, color.name AS "color", size.value AS "size" FROM 
                    size INNER JOIN (product_version INNER JOIN color ON product_version.color_id = color.color_id) ON size.size_id = product_version.size_id
                    WHERE product_version.product_version_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $productVersionId ]);            
            $productVersion = NULL;
            if ($res) {
                $productVersion = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $productVersion;
        }
    }