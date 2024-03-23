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
        Validator::validateNotEmpty($formData, ['name', 'price']);
        Validator::validateNumericPositive($formData, ['price']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $useCase = new CreateProductUseCase($this->productRepo);

        return json_encode($products);
    }
}
