<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;

    class CategoryModel extends Model {

        protected function getFields(): array {
            return [
                'category_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at'    => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),

                'name'          => new Field((new StringValidator())->setMaxLength(64))                
            ];
        }
        
    }