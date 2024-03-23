<?php

namespace App\UseCases\DTO\Product;

class CreateProductInputDto
{
    public function __construct(
        public string $name,
        public float $price
    ) {
    }
}
