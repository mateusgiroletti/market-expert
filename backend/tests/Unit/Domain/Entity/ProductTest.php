<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testAttributes()
    {
        $product = new Product();
        $product->setId(1);
        $product->setName('Teste');
        $product->setPrice(150.50);
        $product->setTaxePercentual(10);

        $this->assertNotEmpty($product->getId());
        $this->assertEquals('Teste', $product->getName());
        $this->assertEquals(150.50, $product->getPrice());
        $this->assertEquals(10, $product->getTaxePercentual());
    }
}
