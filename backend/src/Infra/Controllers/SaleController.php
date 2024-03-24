<?php

namespace Infra\Controllers;

use App\UseCases\DTO\Sale\CreateSaleInputDto;
use App\UseCases\Sale\CreateSaleUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Repositories\PostgreProductTypeRepository;
use Infra\Repositories\PostgreProductTypeTaxesRepository;
use Infra\Repositories\PostgreSaleRepository;
use Infra\Utils\Validator;

class SaleController
{
    private $dbConnection;
    private $saleRepo;
    private $productRepo;
    private $productTypeRepo;
    private $productTypeTaxeRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->saleRepo = new PostgreSaleRepository($this->dbConnection);
        $this->productRepo = new PostgreProductRepository($this->dbConnection);
        $this->productTypeRepo = new PostgreProductTypeRepository($this->dbConnection);
        $this->productTypeTaxeRepo = new PostgreProductTypeTaxesRepository($this->dbConnection);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['products']);

        $useCase = new CreateSaleUseCase(
            $this->saleRepo,
            $this->productRepo,
            $this->productTypeRepo,
            $this->productTypeTaxeRepo,
        );

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
