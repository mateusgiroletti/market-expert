<?php

namespace Infra\Controllers;

use App\UseCases\DTO\ProductTypeTaxes\CreateProductTypeTaxesInputDto;
use App\UseCases\ProductTypeTaxes\CreateProductTypeTaxesUseCase;
use App\UseCases\ProductTypeTaxes\ListProductTypeTaxesUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductTypeTaxesRepository;
use Infra\Utils\Validator;

class ProductTypeTaxesController
{
    private $dbConnection;
    private $productTypeTaxesRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->productTypeTaxesRepo = new PostgreProductTypeTaxesRepository($this->dbConnection);
    }

    public function index($formData)
    {
        $productId = $formData['product_type_id'];

        $useCase = new ListProductTypeTaxesUseCase($this->productTypeTaxesRepo);

        $products = $useCase->execute($productId);

        return json_encode($products);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['product_type_id', 'percentual']);
        Validator::validateNumericPositive($formData, ['product_type_id', 'percentual']);

        $useCase = new CreateProductTypeTaxesUseCase($this->productTypeTaxesRepo);

        $input = new CreateProductTypeTaxesInputDto(
            productTypeId: $formData['product_type_id'],
            percentual: $formData['percentual']
        );

        $isProductTypeTaxesCreate = $useCase->execute($input);

        if (!$isProductTypeTaxesCreate) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'msg' => 'Error when create product type taxes'
            ]);
        }

        http_response_code(201);
        return json_encode([]);
    }
}
