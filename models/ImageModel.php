<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;

    class ImageModel extends Model {

        protected function getFields(): array {
            return [
                'image_id'      => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at'    => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),

                'product_id'    => new Field((new NumberValidator())->setIntegerLength(10)),
                'title'         => new Field((new StringValidator())->setMaxLength(128)),
                'path'          => new Field((new StringValidator())->setMaxLength(255)) 
            ];
        }

        public function getImageByProductId(int $productId) {
            $sql = 'SELECT * FROM image WHERE product_id = ?;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute([ $productId ]);            
            $image = NULL;
            if ($res) {
                $image = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $image;
        }
    }