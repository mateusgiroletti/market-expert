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
