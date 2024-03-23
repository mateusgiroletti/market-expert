<?php

namespace App\UseCases\DTO\ProductType;

class CreateProductTypeInputDto
{
    public function __construct(
        public string $name,
    ) {
    }
}
