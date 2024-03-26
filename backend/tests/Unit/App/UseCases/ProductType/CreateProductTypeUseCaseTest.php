<?php

namespace Tests\Unit\UseCases\ProductType;

use PHPUnit\Framework\TestCase;
use App\UseCases\ProductType\CreateProductTypeUseCase;
use App\UseCases\DTO\ProductType\CreateProductTypeInputDto;
use Domain\Repository\ProductTypeRepositoryInterface;

class CreateProductTypeUseCaseTest extends TestCase
{
    public function testExecute()
    {
        // Arrange
        $productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $inputDto = new CreateProductTypeInputDto(
            name: "Type 1",
            productId: 1,
            percentages: [5, 10],
        );
        $productTypeRepositoryMock->expects($this->once())
            ->method('insert')
            ->willReturn(true); 

        // ACT
        $useCase = new CreateProductTypeUseCase($productTypeRepositoryMock);
        $result = $useCase->execute($inputDto);

        // Assert
        $this->assertTrue($result);
    }
}
