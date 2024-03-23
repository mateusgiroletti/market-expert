<?php

namespace App\UseCases\Product;

use App\UseCases\DTO\Product\UpdateProductInputDto;
use Domain\Entity\Product;
use Domain\Repository\ProductRepositoryInterface;

class UpdateProductUseCase
{
    private ProductRepositoryInterface $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function execute(int $productId, UpdateProductInputDto $input): bool
    {
        $filedsToUpdate = [
            'product_type_id' => $input->productTypeId
        ];

        $isProductUpdate = $this->productRepo->update($productId, $filedsToUpdate);

        return $isProductUpdate;
    }
}
