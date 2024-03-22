<?php

namespace Infra\Controllers;

use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\ListProductUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Utils\Validator;

class ProductController
{
    private $dbConnection;
    private $productRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->productRepo = new PostgreProductRepository($this->dbConnection);
    }

    public function index()
    {
        $useCase = new ListProductUseCase($this->productRepo);

        $products = $useCase->execute();

        return json_encode($products);
    }

    public function show($productId)
    {
        return json_encode($productId);
    }

    public function store($formData)
    {

        if (!Validator::validateNotEmpty($formData, ['name', 'price'])) {
            http_response_code(400);
            $response = ['error' => 'Fields  name and price is required'];
            return json_encode($response);
        }

        if (!Validator::validateNumericPositive($formData, ['price'])) {
            http_response_code(400);
            $response = ['error' => 'Field price must be a positive number'];
            return json_encode($response);
        }

        return;
        $useCase = new CreateProductUseCase($this->productRepo);

        $products = $useCase->execute($product);

        return json_encode($products);
    }
}
