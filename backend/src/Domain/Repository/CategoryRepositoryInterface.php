<?php

namespace Domain\Repository;

use Domain\Entity\ProductType;

interface ProductTypeRepositoryInterface
{
    public function create(ProductType $product): ProductType;
    public function findById(string $productId): ProductType;
    public function findAll(): array;
}
