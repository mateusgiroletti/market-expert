<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\ProductTypeTaxes;
use PHPUnit\Framework\TestCase;

class ProductTypeTaxesTest extends TestCase
{
    public function testAttributes()
    {
        $productTypeTaxes = new ProductTypeTaxes();
        $productTypeTaxes->setId(1);
        $productTypeTaxes->setProductTypeId(1);
        $productTypeTaxes->setPercentual(10);

        $this->assertNotEmpty($productTypeTaxes->getId());
        $this->assertEquals(1, $productTypeTaxes->getProductTypeId());
        $this->assertEquals(10, $productTypeTaxes->getPercentual());
    }
}
