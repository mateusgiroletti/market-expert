<?php

namespace Infra\Controllers;

use App\UseCases\DTO\Product\CreateProductInputDto;
use App\UseCases\DTO\Sale\CreateSaleInputDto;
use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\CreateSaleUseCase;
use App\UseCases\Sale\CreateSaleUseCase as SaleCreateSaleUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Repositories\PostgreSaleRepository;
use Infra\Utils\Validator;

class SaleController
{
    private $dbConnection;
    private $saleRepo;
    private $productRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->saleRepo = new PostgreSaleRepository($this->dbConnection);
        $this->productRepo = new PostgreProductRepository($this->dbConnection);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['products']);

        $useCase = new SaleCreateSaleUseCase($this->saleRepo, $this->productRepo);

        $input = new CreateSaleInputDto(
            products: $formData['products'],
        );

        $newProduct = $useCase->execute($input);

        if (!$newProduct) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'msg' => 'Error when create product'
            ]);
        }

        http_response_code(201);
        return json_encode([]);
    }
}
