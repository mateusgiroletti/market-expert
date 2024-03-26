<?php

namespace Controllers;

use App\UseCases\DTO\Sale\CreateSaleInputDto;
use App\UseCases\Sale\CreateSaleUseCase;
use Controllers\Utils\Validator;

class SaleController
{
    private CreateSaleUseCase $createSaleUseCase;

    public function __construct(
        CreateSaleUseCase $createSaleUseCase
    ) {
        $this->createSaleUseCase = $createSaleUseCase;
    }

    public function store($formData)
    {
        Validator::validateNotEmpty($formData, ['products']);


        $input = new CreateSaleInputDto(
            products: $formData['products'],
        );

        $newProduct = $this->createSaleUseCase->execute($input);

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
