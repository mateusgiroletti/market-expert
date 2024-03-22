<?php

namespace Domain\Repository;

use Domain\Entity\Product;

interface ProductRepositoryInterface
{
    // public function create(Product $productType): Product;
    public function findAll(): array;
}
