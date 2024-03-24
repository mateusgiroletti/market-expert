<?php

namespace App\UseCases\Product;

use App\UseCases\DTO\Product\CreateProductInputDto;
use App\Utils\Helper;
use Domain\Entity\Product;
use Domain\Repository\ProductRepositoryInterface;

class CreateProductUseCase
{
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function execute(CreateProductInputDto $input): bool
    {
        $product = new Product();
        $product->setName($input->name);
        $product->setPrice(Helper::roundToTwoDecimal($input->price));

        $isProductCreate = $this->productRepo->insert($product);

        return $isProductCreate;
    }
}
