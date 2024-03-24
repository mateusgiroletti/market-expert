<?php

namespace Domain\Repository;

use Domain\Entity\ProductTypeTaxes;

interface ProductTypeTaxesRepositoryInterface
{
    public function findAllByProductTypeId(int $productTypeId): array;
    public function insert(ProductTypeTaxes $productTypeTaxe): bool;
}
