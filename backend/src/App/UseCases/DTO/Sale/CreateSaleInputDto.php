<?php

namespace App\UseCases\DTO\Sale;

class CreateSaleInputDto
{
    /**
     * @var array<array{product_id: int, amount: int}>
     */

    public function __construct(
        public array $products,
    ) {
    }
}
