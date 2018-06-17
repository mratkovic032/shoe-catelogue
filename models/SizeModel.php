<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class SizeModel extends Model {

        protected function getFields(): array {
            return [
                'size_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),

                'value'      => new Field((new StringValidator())->setMaxLength(255)) 
            ];
        }
        

        public function getLastSize() {
            $sql = 'SELECT * FROM size ORDER BY size_id DESC LIMIT 1;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute();            
            $size = NULL;
            if ($res) {
                $size = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $size;
        }
    }