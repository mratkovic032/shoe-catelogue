<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;

    class ColorModel extends Model {

        protected function getFields(): array {
            return [
                'color_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),

                'name'       => new Field((new StringValidator())->setMaxLength(255)) 
            ];
        }

        public function getLastColor() {
            $sql = 'SELECT * FROM color ORDER BY color_id DESC LIMIT 1;';
            $prep = $this->getConnection()->prepare($sql);            
            $res = $prep->execute();            
            $color = NULL;
            if ($res) {
                $color = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $color;
        }        
    }