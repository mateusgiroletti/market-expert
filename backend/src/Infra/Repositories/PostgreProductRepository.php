<?php

namespace Infra\Repositories;

use Domain\Entity\Product;
use Domain\Repository\ProductRepositoryInterface;
use Infra\Database\DbConnection;
use PDO;

class PostgreProductRepository implements ProductRepositoryInterface
{
    private PDO $db;

    public function __construct(DbConnection $dbConnection)
    {
        $this->db = $dbConnection->getConnection();
    }

    public function findAll(): array
    {
        try {
            $sql = "SELECT id, name, price FROM products";

            $stmt = $this->db->query($sql);
            $products = [];

            while ($row = $stmt->fetch()) {
                $newProduct = new Product();
                $newProduct->setId($row['id']);
                $newProduct->setName($row['name']);
                $newProduct->setPrice($row['price']);

                $products[] = $newProduct;
            }

            return $products;
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }

    public function findById(int $productId): Product|bool
    {
        try {
            $sql = "SELECT id, name, price FROM products WHERE id = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $productId, PDO::PARAM_INT);
            $stmt->execute();

            $productResult = $stmt->fetch();

            $newProduct = new Product();
            $newProduct->setId($productResult['id']);
            $newProduct->setName($productResult['name']);
            $newProduct->setPrice($productResult['price']);

            return $newProduct;
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }

    public function insert(Product $product): bool
    {
        try {
            $sql = "INSERT INTO products (name, price) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$product->getName(), $product->getPrice()]);
        } catch (\PDOException $e) {
            http_response_code(400);
            throw $e;
            return false;
        }
    }
}
