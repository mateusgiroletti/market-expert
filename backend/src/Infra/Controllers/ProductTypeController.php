<?php

namespace Infra\Controllers;

use App\UseCases\DTO\Product\UpdateProductInputDto;
use App\UseCases\DTO\ProductType\CreateProductTypeInputDto;
use App\UseCases\Product\UpdateProductUseCase;
use App\UseCases\ProductType\CreateProductTypeUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Repositories\PostgreProductTypeRepository;
use Infra\Utils\Validator;

class ProductTypeController
{
    private $dbConnection;
    private $productTypeRepo;
    private $productRepo;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->productTypeRepo = new PostgreProductTypeRepository($this->dbConnection);
        $this->productRepo = new PostgreProductRepository($this->dbConnection);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['name', 'product_id']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $createproductTypeUseCase = new CreateProductTypeUseCase($this->productTypeRepo);

        $input = new CreateProductTypeInputDto(
            name: $formData['name']
        );

        $productTypeId = $createproductTypeUseCase->execute($input);

        if (!$productTypeId) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'msg' => 'Error when create product type'
            ]);
        }

        $productId = $formData['product_id'];

        $updateProductUseCase = new UpdateProductUseCase($this->productRepo);

        $isProductUpdate = $updateProductUseCase->execute(
            $productId,
            input: new UpdateProductInputDto(
                productTypeId: $productTypeId
            )
        );

        if (!$isProductUpdate) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'msg' => 'Error when update product'
            ]);
        }

        http_response_code(201);
        return json_encode([]);
    }
}
