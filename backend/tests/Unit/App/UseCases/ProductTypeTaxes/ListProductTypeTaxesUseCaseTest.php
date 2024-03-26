<?php

namespace Tests\Unit\UseCases\ProductType;

use App\UseCases\ProductTypeTaxes\ListProductTypeTaxesUseCase;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;
use PHPUnit\Framework\TestCase;

class ListProductTypeTaxesUseCaseTest extends TestCase
{
    public function testExecute()
    {
        // Arrange
        $productTypeTaxesRepositoryMock = $this->createMock(ProductTypeTaxesRepositoryInterface::class);
        $productTypeId = 1;
        $mockProductTypeTaxes = [
            ['id' => 1, 'percentual' => 5],
            ['id' => 2, 'percentual' => 10],
            ['id' => 3, 'percentual' => 15],
        ];

        $productTypeTaxesRepositoryMock->expects($this->once())
            ->method('findAllByProductTypeId')
            ->with($productTypeId)
            ->willReturn($mockProductTypeTaxes);

        // ACT
        $listProductTypeTaxesUseCase = new ListProductTypeTaxesUseCase($productTypeTaxesRepositoryMock);
        $result = $listProductTypeTaxesUseCase->execute($productTypeId);

        // Assert
        $this->assertEquals($mockProductTypeTaxes, $result);
    }
}
