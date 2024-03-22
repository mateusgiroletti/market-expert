<?php

namespace Infra\Controllers;

use App\UseCases\Product\ListProductUseCase;
use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;

class ProductController
{
    public function index()
    {
        $db = new DbConnection();
        $productRepo = new PostgreProductRepository($db);
        $useCase = new ListProductUseCase($productRepo);

        $products = $useCase->execute();

        return json_encode($products);

    }

    public function show($productId)
    {
        return json_encode($productId);

    }

    public function store($product)
    {

        return json_encode($product);

    }
}
