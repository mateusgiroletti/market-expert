<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;

use App\UseCases\ProductType\CreateProductTypeUseCase;
use App\UseCases\ProductType\ListProductTypeUseCase;
use Controllers\ProductTypeController;

class ProductTypeControllerTest extends TestCase
{
    public function testIndexReturnsProductTypes()
    {
        // Arrange
        $listProductTypesUseCaseMock = $this->createMock(ListProductTypeUseCase::class);
        $listProductTypesUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(['Product Type 1', 'Product Type 2']);

        // ACT
        $productTypeController = new ProductTypeController(
            $listProductTypesUseCaseMock,
            $this->createMock(CreateProductTypeUseCase::class)
        );
        $result = $productTypeController->index(['product_id' => 1]);

        // Assert
        $this->assertEquals(json_encode(['Product Type 1', 'Product Type 2']), $result);
    }

    public function testStoreWithValidData()
    {
        // Arrange
        $createProductTypeUseCaseMock = $this->createMock(CreateProductTypeUseCase::class);
        $createProductTypeUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // ACT
        $productTypeController = new ProductTypeController(
            $this->createMock(ListProductTypeUseCase::class),
            $createProductTypeUseCaseMock
        );
        $result = $productTypeController->store(['product_id' => 1, 'name' => 'Type']);

        // Assert
        $this->assertEquals(http_response_code(), 201);
        $this->assertEquals(json_encode([]), $result);
    }

    public function testStoreWithInvalidNameData()
    {
        // Arrange
        $productTypeController = new ProductTypeController(
            $this->createMock(ListProductTypeUseCase::class),
            $this->createMock(CreateProductTypeUseCase::class)
        );

        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('name is required');

        // ACT
        $result = $productTypeController->store(['product_id' => 1, 'name' => '']);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type']), $result);
    }

    public function testStoreWithInvalidProductIdData()
    {
        // Arrange
        $productTypeController = new ProductTypeController(
            $this->createMock(ListProductTypeUseCase::class),
            $this->createMock(CreateProductTypeUseCase::class)
        );

        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('product_id is required');

        // ACT
        $result = $productTypeController->store(['name' => 'Type']);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type']), $result);
    }

    public function testStoreWithErrorCreatingProductType()
    {
        // Arrange
        $createProductTypeUseCaseMock = $this->createMock(CreateProductTypeUseCase::class);
        $createProductTypeUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(false);

        // ACT
        $productTypeController = new ProductTypeController(
            $this->createMock(ListProductTypeUseCase::class),
            $createProductTypeUseCaseMock
        );
        $result = $productTypeController->store(['product_id' => 1, 'name' => 'Type']);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product type']), $result);
    }
}
