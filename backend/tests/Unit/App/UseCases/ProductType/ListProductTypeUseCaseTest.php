<?php

namespace Tests\Unit\UseCases\ProductType;

use PHPUnit\Framework\TestCase;
use App\UseCases\ProductType\ListProductTypeUseCase;
use Domain\Repository\ProductTypeRepositoryInterface;

class ListProductTypeUseCaseTest extends TestCase
{
    public function testExecute()
    {
        //Arange
        $productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $productId = 1;
        $mockProductTypes = [
            ['id' => 1, 'name' => 'Type 1'],
            ['id' => 2, 'name' => 'Type 2'],
            ['id' => 3, 'name' => 'Type 3'],
        ];

        $productTypeRepositoryMock->expects($this->once())
            ->method('findAllByProductId')
            ->with($productId)
            ->willReturn($mockProductTypes);

        // ACT
        $listProductTypeUseCase = new ListProductTypeUseCase($productTypeRepositoryMock);
        $result = $listProductTypeUseCase->execute($productId);

        // Assert
        $this->assertEquals($mockProductTypes, $result);
    }
}
