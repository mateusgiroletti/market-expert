<?php

namespace App\UseCases\DTO\ProductType\ProductType;

class CreateProductTypeOutputDto
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
