<?php

namespace App\UseCases\ProductType;

use App\UseCase\DTO\ProductType\CreateProductTypeInputDto;
use App\UseCase\DTO\ProductType\ProductType\CreateProductTypeOutputDto;
use Domain\Entity\ProductType;
use Domain\Repository\ProductTypeRepositoryInterface;

class CreateProductTypeUseCase
{
    private ProductTypeRepositoryInterface $productTypeRepo;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepo)
    {
        $this->productTypeRepo = $productTypeRepo;
    }

    public function execute(CreateProductTypeInputDto $input): CreateProductTypeOutputDto
    {
        $productType = new ProductType(
            name: $input->name
        );

        $newProductType = $this->productTypeRepo->create($productType);

        $productType->setId($newProductType->getId());

        return new CreateProductTypeOutputDto(
            id: $newProductType->getId(),
            name: $productType->getName(),
        );
    }
}
