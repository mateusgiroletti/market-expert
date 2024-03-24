<?php

namespace Infra\Repositories;

use Domain\Entity\ProductType;
use Domain\Repository\ProductTypeRepositoryInterface;
use Infra\Database\DbConnection;
use PDO;

class PostgreProductTypeRepository implements ProductTypeRepositoryInterface
{
    private PDO $db;

    public function __construct(DbConnection $dbConnection)
    {
        $this->db = $dbConnection->getConnection();
    }

    public function findAllByProductId($productId): array
    {
        try {
            $sql = "
                SELECT 
                    pt.id,
                    pt.name,
                    p.id as product_id
                FROM product_types pt
                LEFT JOIN products p ON pt.product_id = p.id  
                WHERE p.id = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $productId, PDO::PARAM_INT);
            $stmt->execute();

            $productsTypesArray = [];

            while ($row = $stmt->fetch()) {
                $newProductType = new ProductType();
                $newProductType->setId($row['id']);
                $newProductType->setName($row['name']);
                $newProductType->setProductId($row['product_id']);

                $newProductTypeItem = [
                    'id' => $newProductType->getId(),
                    'name' => $newProductType->getName(),
                    'product_id' => $newProductType->getProductId(),
                ];
    
                $productsTypesArray[] = $newProductTypeItem;
            }

            return $productsTypesArray;
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }

    public function insert(ProductType $productType): bool
    {
        try {
            $sql = "INSERT INTO product_types (name, product_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productType->getName(), $productType->getProductId()]);

            return true;
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
