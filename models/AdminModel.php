<?php
    namespace App\Models;
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class AdminModel extends Model {

        protected function getFields(): array {
            return [
                'admin_id'        => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at'      => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),
                
                'username'        => new Field((new StringValidator())->setMaxLength(64)),
                'email'           => new Field((new StringValidator())->setMaxLength(255)),
                'password_hash'   => new Field((new StringValidator())->setMaxLength(128)),                
                'is_active'       => new Field(new BitValidator())
            ];
        }
        
        public function getByUsername(string $username) {
            $this->getByFieldName('username', $username);            
        }
    }