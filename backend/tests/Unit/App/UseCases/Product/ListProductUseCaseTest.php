<?php

namespace Tests\Unit\UseCases\Product;

use PHPUnit\Framework\TestCase;
use App\UseCases\Product\ListProductUseCase;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Entity\Product;

class ListProductUseCaseTest extends TestCase
{
    private function createMockProduct($id, $name, $price)
    {
        $product = new Product();
        $product->setId($id);
        $product->setName($name);
        $product->setPrice($price);

        return $product;
    }

    public function testExecute()
    {
        // Arrange
        $productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $mockProducts = [
            $this->createMockProduct(1, 'Product 1', 10.5),
            $this->createMockProduct(2, 'Product 2', 20.0),
            $this->createMockProduct(3, 'Product 3', 15.75),
        ];

        // ACT
        $productRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn($mockProducts);
        $listProductUseCase = new ListProductUseCase($productRepositoryMock);
        $result = $listProductUseCase->execute();

        // Assert
        $this->assertEquals(3, count($result)); 
        foreach ($result as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('name', $product);
            $this->assertArrayHasKey('price', $product);
        }
    }
}
