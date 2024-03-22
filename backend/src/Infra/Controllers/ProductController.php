<?php

namespace Infra\Controllers;

class ProductController
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'Produto 1', 'price' => 10.99],
            ['id' => 2, 'name' => 'Produto 2', 'price' => 20.99],
            ['id' => 3, 'name' => 'Produto 3', 'price' => 30.99]
        ];

        // Converte o array para JSON
        $jsonResponse = json_encode($products);

        // Retorna a resposta JSON
        echo $jsonResponse;
    }

    public function store($product)
    {

        echo json_encode([
            'msg' => 'ok'
        ]);
    }
}
