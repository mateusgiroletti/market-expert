<?php

namespace App\UseCases\DTO\Sale;

class CreateSaleInputDto
{
    public function __construct(
        public string $products,
    ) {
    }
}
