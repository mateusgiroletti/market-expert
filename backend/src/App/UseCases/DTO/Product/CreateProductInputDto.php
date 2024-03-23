<?php

namespace App\UseCases\Dto\Product;

class CreateProductInputDto
{
    public function __construct(
        public string $name,
        public float $price
    ) {
    }
}
