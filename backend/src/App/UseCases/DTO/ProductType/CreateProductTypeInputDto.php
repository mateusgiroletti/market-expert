<?php

namespace App\UseCases\DTO\ProductType;

class CreateProductTypeInputDto
{
    public function __construct(
        public int $productId,
        public string $name,
    ) {
    }
}
