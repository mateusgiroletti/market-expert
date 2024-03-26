<?php

namespace Tests\Unit\UseCases\Sale;

use PHPUnit\Framework\TestCase;
use App\UseCases\Sale\CreateSaleUseCase;
use App\UseCases\DTO\Sale\CreateSaleInputDto;
use Domain\Entity\Product;
use Domain\Repository\SaleRepositoryInterface;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Repository\ProductTypeRepositoryInterface;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;

class CreateSaleUseCaseTest extends TestCase
{
    public function testExecute()
    {
        //Arange
        $saleRepositoryMock = $this->createMock(SaleRepositoryInterface::class);
        $productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $productTypeTaxesRepositoryMock = $this->createMock(ProductTypeTaxesRepositoryInterface::class);

        $inputDto = new CreateSaleInputDto([
            ['product_id' => 1, 'amount' => 2],
            ['product_id' => 2, 'amount' => 3]
        ]);

        $mockProduct1 = new Product();
        $mockProduct1->setPrice(10);
        $mockProduct2 = new Product();
        $mockProduct2->setPrice(20);

        $productRepositoryMock->expects($this->exactly(2))
            ->method('findById')
            ->willReturnMap([
                [1, $mockProduct1],
                [2, $mockProduct2]
            ]);

        $productTypeRepositoryMock->expects($this->exactly(2))
            ->method('findAllByProductId')
            ->willReturn([
                [
                    'id' => 1,
                    'name' => 'Type 1'
                ],
            ]);

        $productTypeTaxesRepositoryMock->expects($this->atLeastOnce())
            ->method('findAllByProductTypeId')
            ->willReturn([
                'id' => 1,
                'product_type_id' => 1,
                'percentual' => 10
            ]);

        $saleRepositoryMock->expects($this->once())
            ->method('insert')
            ->willReturn(true);

        // ACT
        $useCase = new CreateSaleUseCase(
            $saleRepositoryMock,
            $productRepositoryMock,
            $productTypeRepositoryMock,
            $productTypeTaxesRepositoryMock
        );

        // Assert
        $result = $useCase->execute($inputDto);
        $this->assertTrue($result);
    }
}
