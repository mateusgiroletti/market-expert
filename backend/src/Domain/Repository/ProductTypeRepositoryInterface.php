<?php

namespace Domain\Repository;

use Domain\Entity\ProductType;

interface ProductTypeRepositoryInterface
{
    public function insert(ProductType $productType): bool|int;
}
