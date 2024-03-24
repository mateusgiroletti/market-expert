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
        $productsTypesTaxesFromRepo = $this->productTypeTaxeRepo->findAllByProductTypeId($productTypeId);

        $productTypeTaxes = [];

        foreach ($productsTypesTaxesFromRepo as $productTypeTaxe) {
            $newProductTypeTaxe = [
                'id' => $productTypeTaxe->getId(),
                'product_type_id' => $productTypeTaxe->getProductTypeId(),
                'percentual' => $productTypeTaxe->getPercentual(),
            ];

            $productTypeTaxes[] = $newProductTypeTaxe;
        }


        return $productTypeTaxes;
    }
}
