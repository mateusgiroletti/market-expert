<?php

namespace Tests\Unit\UseCases\Product;

use PHPUnit\Framework\TestCase;
use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\DTO\Product\CreateProductInputDto;
use Domain\Repository\ProductRepositoryInterface;

class CreateProductUseCaseTest extends TestCase
{
    public function testCreateProduct()
    {
        // Arrange
        $productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $productRepositoryMock->expects($this->once())
            ->method('insert')
            ->willReturn(true);
        $inputDto = new CreateProductInputDto(
            name: "Product Test",
            price: 10.5
        );

        // ACT
        $useCase = new CreateProductUseCase($productRepositoryMock);
        $result = $useCase->execute($inputDto);

        // Assert
        $this->assertTrue($result);
    }
}
