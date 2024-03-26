<?php

namespace Tests\Unit\UseCases\ProductType;

use App\UseCases\DTO\ProductTypeTaxes\CreateProductTypeTaxesInputDto;
use App\UseCases\ProductTypeTaxes\CreateProductTypeTaxesUseCase;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateProductTypeTaxesUseCaseTest extends TestCase
{
    public function testExecute()
    {
        // Arange
        $productTypeTaxesRepositoryMock = $this->createMock(ProductTypeTaxesRepositoryInterface::class);

        $inputDto = new CreateProductTypeTaxesInputDto(
            productTypeId: 1,
            percentual: 5,
        );

        $productTypeTaxesRepositoryMock->expects($this->once())
            ->method('insert')
            ->willReturn(true); // Simulando que a inserção foi bem-sucedida


        // ACT
        $useCase = new CreateProductTypeTaxesUseCase($productTypeTaxesRepositoryMock);
        $result = $useCase->execute($inputDto);

        // Assert
        $this->assertTrue($result);
    }
}
