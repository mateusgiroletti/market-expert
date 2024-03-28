<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;

use App\UseCases\ProductTypeTaxes\CreateProductTypeTaxesUseCase;
use App\UseCases\ProductTypeTaxes\ListProductTypeTaxesUseCase;
use Controllers\ProductTypeTaxesController;

class ProductTypeTaxesControllerTest extends TestCase
{
    public function testIndexReturnsProductTypesTaxes()
    {
        // Arrange
        $listProductTypeTaxesUseCaseMock = $this->createMock(ListProductTypeTaxesUseCase::class);
        $listProductTypeTaxesUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn([
                [
                    'id' => 1,
                    'product_type_id' => 1,
                    'percentual' => 10
                ],
                [
                    'id' => 2,
                    'product_type_id' => 1,
                    'percentual' => 20
                ]
            ]);

        // ACT
        $productTypeTaxesController = new ProductTypeTaxesController(
            $listProductTypeTaxesUseCaseMock,
            $this->createMock(CreateProductTypeTaxesUseCase::class)
        );
        $result = $productTypeTaxesController->index(['product_type_id' => 1]);

        // Assert
        $this->assertEquals(json_encode([
            [
                'id' => 1,
                'product_type_id' => 1,
                'percentual' => 10
            ],
            [
                'id' => 2,
                'product_type_id' => 1,
                'percentual' => 20
            ]
        ]), $result);
    }

    public function testStoreWithValidData()
    {
        // Arrange
        $createProductTypeTaxesUseCase = $this->createMock(CreateProductTypeTaxesUseCase::class);
        $createProductTypeTaxesUseCase->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // ACT
        $productTypeTaxesController = new ProductTypeTaxesController(
            $this->createMock(ListProductTypeTaxesUseCase::class),
            $createProductTypeTaxesUseCase
        );
        $result = $productTypeTaxesController->store(['product_type_id' => 1, 'percentual' => 30]);

        // Assert
        $this->assertEquals(http_response_code(), 201);
        $this->assertEquals(json_encode([]), $result);
    }

    public function testStoreWithInvalidProductTypeIdData()
    {
        // Arrange
        $productTypeTaxesController = new ProductTypeTaxesController(
            $this->createMock(ListProductTypeTaxesUseCase::class),
            $this->createMock(CreateProductTypeTaxesUseCase::class)
        );

        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('product_type_id is required');

        // ACT
        $result = $productTypeTaxesController->store(['percentual' => 10]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type']), $result);
    }

    public function testStoreWithInvalidPercentualData()
    {
        // Arrange
        $productTypeTaxesController = new ProductTypeTaxesController(
            $this->createMock(ListProductTypeTaxesUseCase::class),
            $this->createMock(CreateProductTypeTaxesUseCase::class)
        );

        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('percentual is required');

        // ACT
        $result = $productTypeTaxesController->store(['product_type_id' => 10]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type']), $result);
    }

    public function testStoreWithErrorCreatingProductTypeTaxes()
    {
        // Arrange
        $createProductTypeTaxesUseCaseMock = $this->createMock(CreateProductTypeTaxesUseCase::class);
        $createProductTypeTaxesUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        // ACT
        $productTypeTaxesController = new ProductTypeTaxesController(
            $this->createMock(ListProductTypeTaxesUseCase::class),
            $createProductTypeTaxesUseCaseMock
        );
        $result = $productTypeTaxesController->store(['product_type_id' => 1, 'percentual' => 30]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type taxes']), $result);
    }
}
