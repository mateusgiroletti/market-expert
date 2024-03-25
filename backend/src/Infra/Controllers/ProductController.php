<?php

namespace Infra\Controllers;

use App\UseCases\DTO\Product\CreateProductInputDto;
use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\FindProductUseCase;
use App\UseCases\Product\ListProductUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Repositories\PostgreProductTypeRepository;
use Infra\Repositories\PostgreProductTypeTaxesRepository;
use Infra\Utils\Validator;

class ProductController
{
    private $dbConnection;
    private $productRepo;
    private $productTypeRepo;
    private $productTypeTaxeRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->productRepo = new PostgreProductRepository($this->dbConnection);
        $this->productTypeRepo = new PostgreProductTypeRepository($this->dbConnection);
        $this->productTypeTaxeRepo = new PostgreProductTypeTaxesRepository($this->dbConnection);
    }

    public function index()
    {
        $useCase = new ListProductUseCase($this->productRepo);

        $products = $useCase->execute();

        return json_encode($products);
    }

    public function show($formData)
    {
        $productId = $formData['product_id'];

        $useCase = new FindProductUseCase(
            $this->productRepo,
            $this->productTypeRepo,
            $this->productTypeTaxeRepo
        );

        $products = $useCase->execute($productId);

        return json_encode($products);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['name', 'price']);
        Validator::validateNumericPositive($formData, ['price']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $useCase = new CreateProductUseCase($this->productRepo);

        $input = new CreateProductInputDto(
            name: $formData['name'],
            price: $formData['price']
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
