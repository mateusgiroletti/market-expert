<?php

namespace Infra\Repositories;

use Domain\Entity\Sale;
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

    public function insert(Sale $sale, array $saleProducts): bool
    {
        try {
            $this->db->beginTransaction();

            $sqlInsertSale = "INSERT INTO sales (total_purchase, total_tax) VALUES (?, ?)";
            $stmtInsertSale = $this->db->prepare($sqlInsertSale);
            $stmtInsertSale->execute([$sale->getTotalPurchase(), $sale->getTotalTax()]);

            $saleId = $this->db->lastInsertId();

            foreach ($saleProducts as $saleProduct) {
                $sqlInsertSaleProduct = "INSERT INTO sales_products (sale_id, product_id, amount, subtotal, total_tax) VALUES (?, ?, ?, ?, ?)";
                $stmtInsertSaleProduct = $this->db->prepare($sqlInsertSaleProduct);
                $stmtInsertSaleProduct->execute([$saleId, $saleProduct->getProductId(), $saleProduct->getAmount(), $saleProduct->getSubtotal(), $saleProduct->getTotalTax()]);
            }

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
