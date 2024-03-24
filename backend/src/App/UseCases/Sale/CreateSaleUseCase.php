<?php

namespace App\UseCases\Sale;

use App\UseCases\DTO\Sale\CreateSaleInputDto;
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

            $totalProduto = $productInfo->getPrice() * $product['amount'];

            $productTypeInfo = $this->productTypeRepo->findAllByProductId($productId);

            $impostoProduto = 0; // Inicializa o imposto total para o produto como 0

            foreach ($productTypeInfo as $productType) {
                $productTypeTaxesInfo = $this->productTypeRepoTaxes->findAllByProductTypeId($productType['id']);

                // Verifica se há impostos associados a este tipo de produto
                if (!empty($productTypeTaxesInfo)) {
                    foreach ($productTypeTaxesInfo as $taxInfo) {
                        $percentualImposto = $taxInfo['percentual'];
                        // Calcula o valor do imposto para esse tipo de produto
                        $impostoProduto += ($totalProduto * $percentualImposto) / 100;
                    }
                }
            }

            // Adiciona o valor total do imposto para este produto ao total de impostos
            $totalTaxes += $impostoProduto;

            // Adiciona o valor do imposto ao preço total do produto
            $totalProdutoComImposto = $totalProduto + $impostoProduto;

            // Atualize a variável $totalPurchase somando o preço total do produto com imposto
            $totalPurchase += $totalProdutoComImposto;

            $saleProduct = new SaleProduct();
            $saleProduct->setProductId($productId);
            $saleProduct->setAmount($product['amount']);
            $saleProduct->setSubtotal($totalProdutoComImposto);
            $saleProduct->setTotalTax($totalTaxes);

            $saleProducts[] = $saleProduct;
        }

        $sale = new Sale();
        $sale->setTotalPurchase($totalPurchase);
        $sale->setTotalTax($totalTaxes);

        $isSaleCreate = $this->saleRepo->insert($sale, $saleProducts);

        return $isSaleCreate;
    }
}
