<?php

namespace App\UseCases\DTO\ProductTypeTaxes;

class CreateProductTypeTaxesInputDto
{
    public function __construct(
        public int $productTypeId,
        public string $percentual,
    ) {
    }
}
