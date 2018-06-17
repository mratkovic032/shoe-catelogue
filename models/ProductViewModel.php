<?php
    namespace App\Models;   
    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\IpAddressValidator;

    class ProductViewModel extends Model {

        protected function getFields(): array {
            return [
                'auction_view_id'   => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at'        => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),

                'product_id'        => new Field((new NumberValidator())->setIntegerLength(10)),
                'ip_address'        => new Field(new IpAddressValidator()),
                'user_agent'        => new Field((new StringValidator())->setMaxLength(255))
            ];
        }
        
        public function getAllByProductId(int $productId): array {
            return $this->getAllByFieldName('product_id', $productId);
        }

        public function getAllByIpAddressId(string $ipAddress): array {
            return $this->getAllByFieldName('ip_address', $ipAddress);
        }
    }