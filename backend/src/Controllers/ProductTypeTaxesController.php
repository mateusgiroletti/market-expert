<?php

namespace Controllers;

use App\UseCases\DTO\ProductTypeTaxes\CreateProductTypeTaxesInputDto;
use App\UseCases\ProductTypeTaxes\CreateProductTypeTaxesUseCase;
use App\UseCases\ProductTypeTaxes\ListProductTypeTaxesUseCase;
use Controllers\Utils\Validator;

class ProductTypeTaxesController
{
    private ListProductTypeTaxesUseCase $listProductTypeTaxesUseCase;
    private CreateProductTypeTaxesUseCase $createProductTypeTaxesUseCase;

    public function __construct(
        ListProductTypeTaxesUseCase $listProductTypeTaxesUseCase,
        CreateProductTypeTaxesUseCase $createProductTypeTaxesUseCase
    ) {
        $this->listProductTypeTaxesUseCase = $listProductTypeTaxesUseCase;
        $this->createProductTypeTaxesUseCase = $createProductTypeTaxesUseCase;
    }

    public function index($formData)
    {
        $productId = $formData['product_type_id'];

        $products = $this->listProductTypeTaxesUseCase->execute($productId);

        return json_encode($products);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['product_type_id', 'percentual']);
        Validator::validateNumericPositive($formData, ['product_type_id', 'percentual']);

        $input = new CreateProductTypeTaxesInputDto(
            productTypeId: $formData['product_type_id'],
            percentual: $formData['percentual']
        );

        $isProductTypeTaxesCreate = $this->createProductTypeTaxesUseCase->execute($input);

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
