<?php

namespace App\UseCases\ProductTypeTaxes;

use App\UseCases\DTO\ProductTypeTaxes\CreateProductTypeTaxesInputDto;
use Domain\Entity\ProductTypeTaxes;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;

class CreateProductTypeTaxesUseCase
{
    private ProductTypeTaxesRepositoryInterface $productTypeTaxesRepo;

    public function __construct(ProductTypeTaxesRepositoryInterface $productTypeTaxesRepo)
    {
        $this->productTypeTaxesRepo = $productTypeTaxesRepo;
    }

    public function execute(CreateProductTypeTaxesInputDto $input): bool
    {
        $productTypeTaxes = new ProductTypeTaxes();
        $productTypeTaxes->setProductTypeId($input->productTypeId);
        $productTypeTaxes->setPercentual($input->percentual);

        $isProductTypeTaxesCreate = $this->productTypeTaxesRepo->insert($productTypeTaxes);

        return $isProductTypeTaxesCreate;
    }
}
