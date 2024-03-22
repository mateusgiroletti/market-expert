<?php

namespace App\UseCase\DTO\ProductType;

class CreateProductTypeInputDto
{
    public function __construct(
        public string $name,
    ) {
    }
}
