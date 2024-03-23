<?php

namespace Domain\Repository;

use Domain\Entity\ProductTypeTaxes;

interface ProductTypeTaxesRepositoryInterface
{
    public function insert(ProductTypeTaxes $productTypeTaxe): bool;
}
