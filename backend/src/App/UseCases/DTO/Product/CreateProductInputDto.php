<?php

namespace App\UseCase\DTO\Product;

class CreateProductInputDto
{
    public function __construct(
        public string $name,
        public float $price,
        public ?int $product_type_id
    ) {
    }
}
