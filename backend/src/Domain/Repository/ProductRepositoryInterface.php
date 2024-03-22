<?php

namespace Domain\Repository;

use Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function insert(Product $product): bool;
    public function findAll(): array;
}
