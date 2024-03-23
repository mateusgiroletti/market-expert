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

    public function insertProductTypeAndUpdateProduct(ProductType $productType, int $productId): bool
    {
        try {
            $this->db->beginTransaction();

            $sqlInsertProductType = "INSERT INTO product_types (name) VALUES (?)";
            $stmtInsertProductType = $this->db->prepare($sqlInsertProductType);
            $stmtInsertProductType->execute([$productType->getName()]);

            $productTypeId = $this->db->lastInsertId();

            $sqlUpdateProduct = "UPDATE products SET product_type_id = (?) WHERE id = (?)";
            $stmtUpdateProduct = $this->db->prepare($sqlUpdateProduct);
            $stmtUpdateProduct->execute([$productTypeId, $productId]);

            $this->db->commit();

            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
