<?php

namespace Domain\Repository;

use Domain\Entity\Sale;

interface SaleRepositoryInterface
{
    public function insert(Sale $sale, array $saleProducts): bool;
}
