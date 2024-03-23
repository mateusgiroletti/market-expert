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

    public function insert(ProductType $productType): bool|int
    {
        try {
            $sql = "INSERT INTO product_types (name) VALUES (?)";
            $stmt = $this->db->prepare($sql);
            $insertionResponse = $stmt->execute([$productType->getName()]);

            if ($insertionResponse) {
                return $this->db->lastInsertId();
            } else {
                throw new \PDOException('Error when creating product type');
            }
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
