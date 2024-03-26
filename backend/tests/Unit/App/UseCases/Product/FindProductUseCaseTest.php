<?php

namespace Tests\Unit\UseCases\Product;

use PHPUnit\Framework\TestCase;
use App\UseCases\Product\FindProductUseCase;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Repository\ProductTypeRepositoryInterface;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;
use Domain\Entity\Product;

class FindProductUseCaseTest extends TestCase
{
    public function testExecute()
    {
        // Arrange
        $productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $productTypeTaxesRepositoryMock = $this->createMock(ProductTypeTaxesRepositoryInterface::class);

        $productId = 1;
        $product = new Product();
        $product->setId($productId);
        $product->setName('Product 1');
        $product->setPrice(10.5);

        $productRepositoryMock->expects($this->once())
            ->method('findById')
            ->with($productId)
            ->willReturn($product);

        $productTypeRepositoryMock->expects($this->once())
            ->method('findAllByProductId')
            ->with($productId)
            ->willReturn([
                ['id' => 1],
                ['id' => 2],
            ]);

        $productTypeTaxesRepositoryMock->expects($this->exactly(2))
            ->method('findAllByProductTypeId')
            ->willReturnOnConsecutiveCalls(
                [['percentual' => 5], ['percentual' => 3]],
                [['percentual' => 2], ['percentual' => 1]]
            );

        // ACT
        $findProductUseCase = new FindProductUseCase($productRepositoryMock, $productTypeRepositoryMock, $productTypeTaxesRepositoryMock);
        $result = $findProductUseCase->execute($productId);

        // Assert
        $expectedResult = [
            'id' => $productId,
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'total_percentage_tax' => 11,
        ];

        $this->assertEquals($expectedResult, $result);
    }
}
