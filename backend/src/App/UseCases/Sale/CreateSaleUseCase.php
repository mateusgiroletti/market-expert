<?php

namespace App\UseCases\Sale;

use App\UseCases\DTO\Sale\CreateSaleInputDto;
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

    public function execute(CreateSaleInputDto $input): bool
    {
        $totalPurchase = 0;
        $totalTaxes = 0;

        $saleProducts = [];

        foreach ($input->products as $product) {
            $productInfo = $this->productRepo->findById($product['product_id']);

            $totalProduct = $productInfo->getPrice() * $product['amount'];

            $taxes = $totalProduct * ($productInfo->getTaxePercentual() / 100);

            $subtotalProduct = $totalProduct + $taxes;

            $totalTaxes += $taxes;
            $totalPurchase += $subtotalProduct;

            $saleProduct = new SaleProduct();
            $saleProduct->setProductId($product['product_id']);
            $saleProduct->setAmount($product['amount']);
            $saleProduct->setSubtotal($subtotalProduct);
            $saleProduct->setTotalTax($taxes);

            $saleProducts[] = $saleProduct;
        }

        $sale = new Sale();
        $sale->setTotalPurchase($totalPurchase);
        $sale->setTotalTax($totalTaxes);

        $isSaleCreate = $this->saleRepo->insert($sale, $saleProducts);

        return $isSaleCreate;
    }
}
