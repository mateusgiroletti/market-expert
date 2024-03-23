<?php

namespace Infra\Repositories;

use Domain\Entity\Sale;
use Domain\Entity\SaleProduct;
use Domain\Repository\SaleRepositoryInterface;
use Infra\Database\DbConnection;
use PDO;

class PostgreSaleRepository implements SaleRepositoryInterface
{
    private PDO $db;

    public function __construct(DbConnection $dbConnection)
    {
        $this->db = $dbConnection->getConnection();
    }

    public function insert(Sale $sale, SaleProduct $saleProducts): bool
    {
        try {
            $sql = "INSERT INTO sales (total_purchase, total_tax) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$sale->getTotalPurchase(), $sale->getTotalTax()]);

            $saleId = $this->db->lastInsertId();
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
