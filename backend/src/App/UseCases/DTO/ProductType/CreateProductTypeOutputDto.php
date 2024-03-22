<?php

namespace App\UseCase\DTO\ProductType\ProductType;

class CreateProductTypeOutputDto
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
