<?php

namespace App\UseCases\Product;

use Domain\Repository\ProductRepositoryInterface;
use Domain\Repository\ProductTypeRepositoryInterface;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;

class FindProductUseCase
{
    private ProductRepositoryInterface $productRepo;
    private ProductTypeRepositoryInterface $productTypeRepo;
    private ProductTypeTaxesRepositoryInterface $productTypeRepoTaxes;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductTypeRepositoryInterface $productTypeRepo,
        ProductTypeTaxesRepositoryInterface $productTypeRepoTaxes

    ) {
        $this->productRepo = $productRepo;
        $this->productTypeRepo = $productTypeRepo;
        $this->productTypeRepoTaxes = $productTypeRepoTaxes;
    }

    public function execute(int $productId)
    {
        $productFromRepo = $this->productRepo->findById($productId);

        $productTypeInfo = $this->productTypeRepo->findAllByProductId($productFromRepo->getId());
        $totalPercentageTax = 0;

        if (!empty($productTypeInfo)) {
            foreach ($productTypeInfo as $key => $productType) {
                $productTypeTaxesInfo = $this->productTypeRepoTaxes->findAllByProductTypeId($productType['id']);
                if (!empty($productTypeTaxesInfo)) {
                    foreach ($productTypeTaxesInfo as $productTaxes) {
                        $totalPercentageTax += $productTaxes['percentual'];
                    }
                }
            }
        }

        $productResponse = [
            'id' => $productFromRepo->getId(),
            'name' => $productFromRepo->getName(),
            'price' => $productFromRepo->getPrice(),
            'total_percentage_tax' => $totalPercentageTax
        ];

        return $productResponse;
    }
}
