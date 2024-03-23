<?php

namespace App\UseCases\Sale;

use App\UseCases\DTO\Product\CreateProductInputDto;
use Domain\Entity\Product;
use Domain\Entity\Sale;
use Domain\Entity\SaleProduct;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Repository\SaleRepositoryInterface;

class CreateSaleUseCase
{
    private SaleRepositoryInterface $saleRepo;
    private ProductRepositoryInterface $productRepo;

    public function __construct(
        SaleRepositoryInterface $saleRepo,
        ProductRepositoryInterface $productRepo
    ) {
        $this->saleRepo = $saleRepo;
        $this->productRepo = $productRepo;
    }

    public function execute(array $input): bool
    {

        $totalCompra = 0;
        $totalTaxes = 0;

        foreach ($input as $product) {
            $productInfo = $this->productRepo->findById($product['product_id']);

            $taxes = $productInfo->getPrice() * ($productInfo->getTaxePercentual() / 100) * $product['amount'];

            $totalTaxes += $taxes;
        }

        var_dump($totalTaxes);

        return true;
    }
}
