<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\Sale;
use PHPUnit\Framework\TestCase;

class SaleTest extends TestCase
{
    public function testAttributes()
    {
        $sale = new Sale();
        $sale->setId(1);
        $sale->setTotalPurchase(150.50);
        $sale->setTotalTax(80);

        $this->assertNotEmpty($sale->getId());
        $this->assertEquals(150.50, $sale->getTotalPurchase());
        $this->assertEquals(80, $sale->getTotalTax());
    }
}
