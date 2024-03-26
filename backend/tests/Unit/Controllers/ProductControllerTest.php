<?php

namespace Tests\Controllers;

use Controllers\ProductController;
use PHPUnit\Framework\TestCase;
use App\UseCases\Product\ListProductUseCase;
use App\UseCases\Product\FindProductUseCase;
use App\UseCases\Product\CreateProductUseCase;

class ProductControllerTest extends TestCase
{
    public function testIndexReturnsProducts()
    {
        // Arrange
        $listProductUseCaseMock = $this->createMock(ListProductUseCase::class);
        $listProductUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(['Product 1', 'Product 2']);

        // ACT
        $productController = new ProductController(
            $listProductUseCaseMock,
            $this->createMock(FindProductUseCase::class),
            $this->createMock(CreateProductUseCase::class)
        );
        $result = $productController->index();

        // Assert
        $this->assertEquals(json_encode(['Product 1', 'Product 2']), $result);
    }

    public function testShowReturnsProduct()
    {
        // Arrange
        $findProductUseCaseMock = $this->createMock(FindProductUseCase::class);
        $findProductUseCaseMock->expects($this->once())
            ->method('execute')
            ->with(123)
            ->willReturn(['id' => 123, 'name' => 'Product', 'price' => 10]);

        // ACT
        $productController = new ProductController(
            $this->createMock(ListProductUseCase::class),
            $findProductUseCaseMock,
            $this->createMock(CreateProductUseCase::class)
        );
        $result = $productController->show(['product_id' => 123]);

        // Assert
        $this->assertEquals(json_encode(['id' => 123, 'name' => 'Product', 'price' => 10]), $result);
    }

    public function testStoreWithValidData()
    {
        // Arrange
        $createProductUseCaseMock = $this->createMock(CreateProductUseCase::class);
        $createProductUseCaseMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        // ACT
        $productController = new ProductController(
            $this->createMock(ListProductUseCase::class),
            $this->createMock(FindProductUseCase::class),
            $createProductUseCaseMock
        );
        $result = $productController->store(['name' => 'Product', 'price' => 10]);

        // Assert
        $this->assertEquals(http_response_code(), 201);
        $this->assertEquals(json_encode([]), $result);
    }

    public function testStoreWithInvalidNameData()
    {
        // Arrange
        $productController = new ProductController(
            $this->createMock(ListProductUseCase::class),
            $this->createMock(FindProductUseCase::class),
            $this->createMock(CreateProductUseCase::class)
        );

        // ACT
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('name is required');

        $result = $productController->store(['price' => 20]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product']), $result);
    }

    public function testStoreWithInvalidPriceData()
    {
        // Arrange
        $productController = new ProductController(
            $this->createMock(ListProductUseCase::class),
            $this->createMock(FindProductUseCase::class),
            $this->createMock(CreateProductUseCase::class)
        );

        // ACT
        $this->expectException(\ErrorException::class);
        $this->expectExceptionMessage('price must be a positive number');

        $result = $productController->store(['name' => 'teste', 'price' => -20]);

        // Assert
        $this->assertEquals(http_response_code(), 400);
        $this->assertEquals(json_encode(['error' => true, 'msg' => 'Error when create product']), $result);
    }
}
