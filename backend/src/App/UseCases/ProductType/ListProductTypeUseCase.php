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
        $productTypes = $this->productTypeRepo->findAllByProductId($productId);

        return $productTypes;
    }
}
