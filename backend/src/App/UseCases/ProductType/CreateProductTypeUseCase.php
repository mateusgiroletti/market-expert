<?php

namespace App\UseCases\ProductType;

use App\UseCases\DTO\ProductType\CreateProductTypeInputDto;
use Domain\Entity\ProductType;
use Domain\Repository\ProductTypeRepositoryInterface;

class CreateProductTypeUseCase
{
    private ProductTypeRepositoryInterface $productTypeRepo;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepo)
    {
        $this->productTypeRepo = $productTypeRepo;
    }

    public function execute(CreateProductTypeInputDto $input): bool
    {
        $productType = new ProductType();
        $productType->setName($input->name);
        $productType->setProductId($input->productId);

        $isProductTypeCreate = $this->productTypeRepo->insert(
            $productType
        );

        return $isProductTypeCreate;
    }
}
