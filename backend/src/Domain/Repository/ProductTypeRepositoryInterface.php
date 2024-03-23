<?php

namespace Domain\Repository;

use Domain\Entity\ProductType;

interface ProductTypeRepositoryInterface
{
    public function insertProductTypeAndUpdateProduct(ProductType $productType, int $productId): bool;
}
