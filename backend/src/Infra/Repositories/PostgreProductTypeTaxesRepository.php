<?php

namespace Infra\Repositories;

use Domain\Entity\ProductTypeTaxes;
use Domain\Repository\ProductTypeTaxesRepositoryInterface;
use Infra\Database\DbConnection;
use PDO;

class PostgreProductTypeTaxesRepository implements ProductTypeTaxesRepositoryInterface
{
    private PDO $db;

    public function __construct(DbConnection $dbConnection)
    {
        $this->db = $dbConnection->getConnection();
    }

    public function findAllByProductTypeId($productTypeId): array
    {
        try {
            $sql = "
                SELECT 
                    ptt.id,
                    ptt.percentual,
                    pt.id as product_type_id
                FROM product_type_taxes ptt
                LEFT JOIN product_types pt ON pt.id = ptt.product_type_id  
                WHERE pt.id = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $productTypeId, PDO::PARAM_INT);
            $stmt->execute();

            $productsTypeTaxesArray = [];

            while ($row = $stmt->fetch()) {
                $newProductTypeTaxe = new ProductTypeTaxes();
                $newProductTypeTaxe->setId($row['id']);
                $newProductTypeTaxe->setPercentual($row['percentual']);
                $newProductTypeTaxe->setProductTypeId($row['product_type_id']);

                $newProductTypeTaxeItem = [
                    'id' => $newProductTypeTaxe->getId(),
                    'product_type_id' => $newProductTypeTaxe->getProductTypeId(),
                    'percentual' => $newProductTypeTaxe->getPercentual(),
                ];

                $productsTypeTaxesArray[] = $newProductTypeTaxeItem;
            }

            return $productsTypeTaxesArray;
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }


    public function insert(ProductTypeTaxes $productType): bool
    {
        try {
            $sql = "INSERT INTO product_type_taxes (product_type_id, percentual) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$productType->getProductTypeId(), $productType->getPercentual()]);
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
