<?php

namespace Tests\Unit\Domain\Entity;

use Domain\Entity\ProductType;
use PHPUnit\Framework\TestCase;
use Throwable;

class ProductTypeTest extends TestCase
{

    public function testAttributes()
    {
        $productType = new ProductType($name = 'New Product');
        $productType->setId(1);

        $this->assertNotEmpty($productType->getId());
        $this->assertEquals('New Product', $productType->getName());
    }
}
