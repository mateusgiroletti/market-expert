<?php

namespace Tests\Controllers;

use App\UseCases\Sale\CreateSaleUseCase;
use Controllers\SaleController;
use PHPUnit\Framework\TestCase;

class SaleControllerTest extends TestCase
{
    public function testStoreWithValidData()
    {
        // Arrange
        $createSaleUseCaseMock = $this->createMock(CreateSaleUseCase::class);
        $createSaleUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // ACT
        $productController = new SaleController(
            $createSaleUseCaseMock
        );
        $result = $productController->store([
            "products" => [
                [
                    "product_id" => 1,
                    "amount" => 4
                ],
                [
                    "product_id" => 2,
                    "amount" => 3
                ]
            ]
        ]);

        // Assert
        $this->assertEquals(http_response_code(), 201);
        $this->assertEquals(json_encode([]), $result);
    }

    public function testStoreWithInvalidProductsData()
    {
        // Arrange
        $saleController = new SaleController(
            $this->createMock(CreateSaleUseCase::class),
        );

        // ACT
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('products is required');

        $result = $saleController->store([]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product']), $result);
    }
}
