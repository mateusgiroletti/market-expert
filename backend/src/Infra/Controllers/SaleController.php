<?php

namespace Infra\Controllers;

use App\UseCases\DTO\Product\CreateProductInputDto;
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

        $products = $formData['products'];

        /*  $input = new CreateProductInputDto(
            name: $formData['name'],
            price: $formData['price']
        ); */

        $newProduct = $useCase->execute($products);

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
