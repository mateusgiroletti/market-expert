<?php

namespace App\UseCases\DTO\Product;

class UpdateProductInputDto
{
    public function __construct(
        public ?int $productTypeId
    ) {
    }
}
