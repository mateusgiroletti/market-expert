<?php

namespace App\UseCases\Sale;

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

        $saleProducts = [];

        foreach ($input as $product) {
            $productInfo = $this->productRepo->findById($product['product_id']);

            // valor do produto X quantidade
            $totalProduct = $productInfo->getPrice() * $product['amount'];

            //Total de taxes de um produto
            $taxes = ($productInfo->getPrice() * ($productInfo->getTaxePercentual() / 100)) * $product['amount'];

            // subtotal do produto
            $subtotalProduct = $totalProduct + $taxes;

            //Soma total de taxes dos produtos
            $totalTaxes += $taxes;

            $totalCompra += $subtotalProduct;

            /* sale_id => definir no repository quando criar a venda
             */

            $saleProduct = new SaleProduct();
            $saleProduct->setProductId($product['product_id']);
            $saleProduct->setAmount($product['amount']);
            $saleProduct->setSubtotal($subtotalProduct);
            $saleProduct->setTotalTax($taxes);

            $saleProducts[] = $saleProduct;
        }

        $sale = new Sale();
        $sale->setTotalPurchase($totalCompra);
        $sale->setTotalTax($totalTaxes);

        // var_dump($saleProducts);

        $isSaleCreate = $this->saleRepo->insert($sale, $saleProducts);

        return true;
    }
}
