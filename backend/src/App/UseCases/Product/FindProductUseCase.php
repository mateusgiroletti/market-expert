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

        $productResponse = [
            'id' => $productFromRepo->getId(),
            'name' => $productFromRepo->getName(),
            'product_types' => [],
        ];

        $productTypeInfo = $this->productTypeRepo->findAllByProductId($productFromRepo->getId());
        if (!empty($productTypeInfo)) {


            foreach ($productTypeInfo as $key => $productType) {
                $porcentagens = [];

                $productResponse['product_types'][] = [
                    'product_type_id' => $productType['id'],
                    'name' => $productType['name'],
                    'porcentagens' => []
                ];

                $productTypeTaxesInfo = $this->productTypeRepoTaxes->findAllByProductTypeId($productType['id']);

                if (!empty($productTypeTaxesInfo)) {
                    foreach ($productTypeTaxesInfo as $productTaxes) {
                        array_push($porcentagens, $productTaxes['percentual']);
                    }
                }

                $productResponse['product_types'][$key]['porcentagens'] = $porcentagens;
            }
        }


        return $productResponse;
    }
}
