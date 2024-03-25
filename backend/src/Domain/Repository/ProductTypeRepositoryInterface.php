<?php

namespace Domain\Repository;

use Domain\Entity\ProductType;

interface ProductTypeRepositoryInterface
{
    public function findAllByProductId(int $productId): array;
    public function insert(ProductType $productType, ?array $productTypeTaxes): bool;
}
