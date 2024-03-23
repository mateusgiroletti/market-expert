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

    public function execute(CreateProductTypeInputDto $input): bool|int
    {
        $productType = new ProductType();
        $productType->setName($input->name);

        $productTypeId = $this->productTypeRepo->insert($productType);

        if(!$productTypeId){
            return false;
        }

        return $productTypeId;
    }
}
