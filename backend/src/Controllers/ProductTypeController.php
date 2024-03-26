<?php

namespace Controllers;

use App\UseCases\DTO\ProductType\CreateProductTypeInputDto;
use App\UseCases\ProductType\CreateProductTypeUseCase;
use App\UseCases\ProductType\ListProductTypeUseCase;
use Controllers\Utils\Validator;

class ProductTypeController
{
    private ListProductTypeUseCase $listProductTypeUseCase;
    private CreateProductTypeUseCase $createProductTypeUseCase;

    public function __construct(
        ListProductTypeUseCase  $listProductTypeUseCase,
        CreateProductTypeUseCase $createProductTypeUseCase
    ) {
        $this->listProductTypeUseCase = $listProductTypeUseCase;
        $this->createProductTypeUseCase = $createProductTypeUseCase;
    }

    public function index($formData)
    {
        $productId = $formData['product_id'];

        $products = $this->listProductTypeUseCase->execute($productId);

        return json_encode($products);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['name', 'product_id']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $input = new CreateProductTypeInputDto(
            productId: $formData['product_id'],
            name: $formData['name'],
            percentages: !empty($formData['percentages']) ? $formData['percentages'] : null
        );

        $isProductTypeCreate = $this->createProductTypeUseCase->execute($input);

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
