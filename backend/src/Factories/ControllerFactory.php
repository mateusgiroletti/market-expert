<?php

namespace Factories;

use App\UseCases\Product\CreateProductUseCase;
use App\UseCases\Product\FindProductUseCase;
use App\UseCases\Product\ListProductUseCase;
use App\UseCases\ProductType\CreateProductTypeUseCase;
use App\UseCases\ProductType\ListProductTypeUseCase;
use App\UseCases\ProductTypeTaxes\CreateProductTypeTaxesUseCase;
use App\UseCases\ProductTypeTaxes\ListProductTypeTaxesUseCase;
use App\UseCases\Sale\CreateSaleUseCase;

use Controllers\ProductController;
use Controllers\ProductTypeController;
use Controllers\ProductTypeTaxesController;
use Controllers\SaleController;

use Infra\Database\DbConnection;
use Infra\Repositories\PostgreProductRepository;
use Infra\Repositories\PostgreProductTypeRepository;
use Infra\Repositories\PostgreProductTypeTaxesRepository;
use Infra\Repositories\PostgreSaleRepository;

use InvalidArgumentException;

class ControllerFactory
{
    public static function create(string $controllerClass): object
    {
        if ($controllerClass === ProductController::class) {
            $dbConnection = new DbConnection();

            $postgreProductRepository = new PostgreProductRepository($dbConnection);
            $postgreProductTypeRepository = new PostgreProductTypeRepository($dbConnection);
            $postgreProductTypeTaxesRepository = new PostgreProductTypeTaxesRepository($dbConnection);

            $listProductUseCase = new ListProductUseCase($postgreProductRepository);

            $findProductUseCase = new FindProductUseCase(
                $postgreProductRepository,
                $postgreProductTypeRepository,
                $postgreProductTypeTaxesRepository
            );

            $createProductUseCase = new CreateProductUseCase($postgreProductRepository);

            return new $controllerClass($listProductUseCase, $findProductUseCase, $createProductUseCase);
        }

        if ($controllerClass === ProductTypeController::class) {
            $dbConnection = new DbConnection();

            $prostgreProductTypeRepository = new PostgreProductTypeRepository($dbConnection);

            $listProductTypeUseCase = new ListProductTypeUseCase(
                $prostgreProductTypeRepository
            );

            $createProductTypeUseCase = new CreateProductTypeUseCase(
                $prostgreProductTypeRepository
            );

            return new $controllerClass($listProductTypeUseCase, $createProductTypeUseCase);
        }

        if ($controllerClass === ProductTypeTaxesController::class) {
            $dbConnection = new DbConnection();

            $prostgreProductTypeTaxesRepository = new PostgreProductTypeTaxesRepository($dbConnection);

            $listProductTypeTaxesUseCase = new ListProductTypeTaxesUseCase(
                $prostgreProductTypeTaxesRepository
            );

            $createProductTypeTaxesUseCase = new CreateProductTypeTaxesUseCase(
                $prostgreProductTypeTaxesRepository
            );

            return new $controllerClass($listProductTypeTaxesUseCase, $createProductTypeTaxesUseCase);
        }

        if ($controllerClass === SaleController::class) {
            $dbConnection = new DbConnection();

            $postgreSaleRepository = new PostgreSaleRepository($dbConnection);
            $postgreProductRepository = new PostgreProductRepository($dbConnection);
            $postgreProductTypeRepository = new PostgreProductTypeRepository($dbConnection);
            $postgreProductTypeTaxesRepository = new PostgreProductTypeTaxesRepository($dbConnection);

            $createSaleUseCase = new CreateSaleUseCase(
                $postgreSaleRepository,
                $postgreProductRepository,
                $postgreProductTypeRepository,
                $postgreProductTypeTaxesRepository,
            );

            return new $controllerClass($createSaleUseCase);
        }

        throw new InvalidArgumentException("Controller class '$controllerClass' not supported");
    }
}
