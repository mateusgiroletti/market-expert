<?php

namespace App\UseCases\Product;

use Domain\Repository\ProductRepositoryInterface;

class ListProductUseCase
{
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function execute(): array
    {
        $productsFromRepository = $this->productRepo->findAll();
        $products = [];

        foreach ($productsFromRepository as $product) {
            $newProduct = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'product_type_id' => $product->getProductTypeId(),
                'price' => $product->getPrice(),
            ];

            $products[] = $newProduct;
        }

        return $products;
    }
}
