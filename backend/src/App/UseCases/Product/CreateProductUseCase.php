<?php

namespace App\UseCases\Product;

use App\UseCase\DTO\Product\CreateProductInputDto;
use Domain\Entity\Product;
use Domain\Repository\ProductRepositoryInterface;

class CreateProductUseCase
{
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function execute(CreateProductInputDto $input): void
    {
        $product = new Product();
        $product->setName($input->name);
        $product->setPrice($input->price);

        $newProduct = $this->productRepo->insert($product);

        var_dump($newProduct);
    }
}
