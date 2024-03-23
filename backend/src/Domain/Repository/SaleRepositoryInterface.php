<?php

namespace Domain\Repository;

use Domain\Entity\Sale;
use Domain\Entity\SaleProduct;

interface SaleRepositoryInterface
{
    public function insert(Sale $sale, SaleProduct $saleProducts): bool;
}
