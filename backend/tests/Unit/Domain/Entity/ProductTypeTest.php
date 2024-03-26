<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\ProductType;
use PHPUnit\Framework\TestCase;

class ProductTypeTest extends TestCase
{
    public function testAttributes()
    {
        $productType = new ProductType();
        $productType->setId(1);
        $productType->setName('Teste');
        $productType->setProductId(1);

        $this->assertNotEmpty($productType->getId());
        $this->assertEquals('Teste', $productType->getName());
        $this->assertEquals(1, $productType->getProductId());
    }
}
