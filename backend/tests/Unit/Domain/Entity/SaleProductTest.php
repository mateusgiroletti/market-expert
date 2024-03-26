<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\SaleProduct;
use PHPUnit\Framework\TestCase;

class SaleProductTest extends TestCase
{
    public function testAttributes()
    {
        $saleProduct = new SaleProduct();
        $saleProduct->setId(1);
        $saleProduct->setSaleId(2);
        $saleProduct->setProductId(3);
        $saleProduct->setAmount(3);
        $saleProduct->setSubtotal(150.50);
        $saleProduct->setTotalTax(75.50);

        $this->assertNotEmpty($saleProduct->getId());
        $this->assertNotEmpty($saleProduct->getSaleId());
        $this->assertNotEmpty($saleProduct->getProductId());
        $this->assertEquals(3, $saleProduct->getAmount());
        $this->assertEquals(150.50, $saleProduct->getSubtotal());
        $this->assertEquals(75.50, $saleProduct->getTotalTax());
    }
}
