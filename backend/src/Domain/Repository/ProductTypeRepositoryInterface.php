<?php

namespace Domain\Repository;

use Domain\Entity\ProductType;

interface ProductTypeRepositoryInterface
{
    public function create(ProductType $productType): ProductType;
    public function findById(string $productTypeId): ProductType;
    public function findAll(): array;
}
