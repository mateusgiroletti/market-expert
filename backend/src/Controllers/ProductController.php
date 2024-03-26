<?php

namespace Controllers;

use App\UseCases\DTO\Product\CreateProductInputDto;
use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\FindProductUseCase;
use App\UseCases\Product\ListProductUseCase;
use Controllers\Utils\Validator;

class ProductController
{
    private ListProductUseCase $listProductUseCase;
    private FindProductUseCase $findProductUseCase;
    private CreateProductUseCase $createProductUseCase;

    public function __construct(
        ListProductUseCase $listProductUseCase,
        FindProductUseCase $findProductUseCase,
        CreateProductUseCase $createProductUseCase
    ) {
        $this->listProductUseCase = $listProductUseCase;
        $this->findProductUseCase = $findProductUseCase;
        $this->createProductUseCase = $createProductUseCase;
    }
    public function index()
    {
        $products = $this->listProductUseCase->execute();

        return json_encode($products);
    }

    public function show($formData)
    {
        $productId = $formData['product_id'];

        $products = $this->findProductUseCase->execute($productId);

        return json_encode($products);
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['name', 'price']);
        Validator::validateNumericPositive($formData, ['price']);
        Validator::validateMaxLength($formData, ['name'], 100);
        Validator::validateMinLength($formData, ['name'], 2);

        $input = new CreateProductInputDto(
            name: $formData['name'],
            price: $formData['price']
        );

        $newProduct = $this->createProductUseCase->execute($input);

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
