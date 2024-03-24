<?php

namespace App\UseCases\ProductTypeTaxes;

use Domain\Repository\ProductTypeTaxesRepositoryInterface;

class ListProductTypeTaxesUseCase
{
    private ProductTypeTaxesRepositoryInterface $productTypeTaxeRepo;

    public function __construct(ProductTypeTaxesRepositoryInterface $productTypeTaxeRepo)
    {
        $this->productTypeTaxeRepo = $productTypeTaxeRepo;
    }

    public function execute(int $productTypeId): array
    {
        $productsTypesTaxes = $this->productTypeTaxeRepo->findAllByProductTypeId($productTypeId);

        return $productsTypesTaxes;
    }
}
