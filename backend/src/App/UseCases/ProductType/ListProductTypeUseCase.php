<?php

namespace App\UseCases\ProductType;

use Domain\Repository\ProductTypeRepositoryInterface;

class ListProductTypeUseCase
{
    private ProductTypeRepositoryInterface $productTypeRepo;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepo)
    {
        $this->productTypeRepo = $productTypeRepo;
    }

    public function execute(int $productId): array
    {
        $productsTypesFromRepo = $this->productTypeRepo->findAllByProductId($productId);

        $productTypes = [];

        foreach ($productsTypesFromRepo as $productType) {
            $newProductType = [
                'id' => $productType->getId(),
                'name' => $productType->getName(),
                'product_id' => $productType->getProductId(),
            ];

            $productTypes[] = $newProductType;
        }


        return $productTypes;
    }
}
