<?php

namespace App\UseCases\Sale;

use App\UseCases\DTO\Sale\CreateSaleInputDto;
use App\Utils\Helper;
use Domain\Entity\Sale;
use Domain\Entity\SaleProduct;
use Domain\Repository\ProductRepositoryInterface;
use Domain\Repository\ProductTypeRepositoryInterface;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;
use Domain\Repository\SaleRepositoryInterface;

class CreateSaleUseCase
{
    private SaleRepositoryInterface $saleRepo;
    private ProductRepositoryInterface $productRepo;
    private ProductTypeRepositoryInterface $productTypeRepo;
    private ProductTypeTaxesRepositoryInterface $productTypeRepoTaxes;

    public function __construct(
        SaleRepositoryInterface $saleRepo,
        ProductRepositoryInterface $productRepo,
        ProductTypeRepositoryInterface $productTypeRepo,
        ProductTypeTaxesRepositoryInterface $productTypeRepoTaxes
    ) {
        $this->saleRepo = $saleRepo;
        $this->productRepo = $productRepo;
        $this->productTypeRepo = $productTypeRepo;
        $this->productTypeRepoTaxes = $productTypeRepoTaxes;
    }

    public function execute(CreateSaleInputDto $input): bool
    {
        $formProduct = $input->products;

        $totalPurchase = 0;
        $totalTaxes = 0;
        $saleProducts = [];

        foreach ($formProduct as $product) {
            $productId = $product['product_id'];

            $productInfo = $this->productRepo->findById($productId);

            $totalProduct = $productInfo->getPrice() * $product['amount'];

            $productTypeInfo = $this->productTypeRepo->findAllByProductId($productId);

            $productTax = 0;

            foreach ($productTypeInfo as $productType) {
                $productTypeTaxesInfo = $this->productTypeRepoTaxes->findAllByProductTypeId($productType['id']);

                // Verifica se há impostos associados a este tipo de produto
                if (!empty($productTypeTaxesInfo)) {
                    foreach ($productTypeTaxesInfo as $taxInfo) {
                        $taxPercentual = $taxInfo['percentual'] / 100;

                        // Calcula o valor do imposto para esse tipo de produto
                        $productTax += $totalProduct * $taxPercentual;
                    }
                }
            }

            // Adiciona o valor total do imposto para este produto ao total de impostos
            $totalTaxes += $productTax;

            // Adiciona o valor do imposto ao preco total do produto
            $productTotalWithTax = $totalProduct + $productTax;

            // Atualize a variável $totalPurchase somando o preço total do produto com imposto
            $totalPurchase += $productTotalWithTax;

            $saleProduct = new SaleProduct();
            $saleProduct->setProductId($productId);
            $saleProduct->setAmount($product['amount']);
            $saleProduct->setSubtotal(Helper::roundToTwoDecimal($productTotalWithTax));
            $saleProduct->setTotalTax(Helper::roundToTwoDecimal($productTax));

            $saleProducts[] = $saleProduct;
        }

        $sale = new Sale();
        $sale->setTotalPurchase(Helper::roundToTwoDecimal($totalPurchase));
        $sale->setTotalTax(Helper::roundToTwoDecimal($totalTaxes));

        $isSaleCreate = $this->saleRepo->insert($sale, $saleProducts);

        return $isSaleCreate;
    }
}
