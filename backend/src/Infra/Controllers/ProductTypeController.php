<?php

namespace Infra\Controllers;

use App\UseCases\DTO\ProductType\CreateProductTypeInputDto;
use App\UseCases\ProductType\CreateProductTypeUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductTypeRepository;
use Infra\Utils\Validator;

class ProductTypeController
{
    private $dbConnection;
    private $productTypeRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->productTypeRepo = new PostgreProductTypeRepository($this->dbConnection);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['name', 'product_id']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $useCase = new CreateProductTypeUseCase($this->productTypeRepo);

        $input = new CreateProductTypeInputDto(
            productId: $formData['product_id'],
            name: $formData['name']
        );

        $isProductTypeCreate = $useCase->execute($input);

        if (!$isProductTypeCreate) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'msg' => 'Error when create product type'
            ]);
        }

        http_response_code(201);
        return json_encode([]);
    }
}
