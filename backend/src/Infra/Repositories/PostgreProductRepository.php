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

    public function insert(Product $product): bool {
        $sql = "INSERT INTO product (name, price) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$product->getName(), $product->getPrice()]);
    }

    public function findAll(): array
    {
        $sql = "SELECT id, name, product_type_id, price FROM product";

        $stmt = $this->db->query($sql);
        $products = [];

        while ($row = $stmt->fetch()) {
            $newProduct = new Product();
            $newProduct->setId($row['id']);
            $newProduct->setProductTypeId($row['product_type_id']);
            $newProduct->setName($row['name']);
            $newProduct->setPrice($row['price']);

            $products[] = $newProduct;
        }

        return $products;
    }
}