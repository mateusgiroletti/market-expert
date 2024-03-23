<?php

namespace Domain\Entity;

class Product
{
    private ?int $id = 0;
    private int|null $productTypeId;
    private string $name;
    private float $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductTypeId(): int|null
    {
        return $this->productTypeId;
    }

    public function setProductTypeId(int|null $productTypeId): void
    {
        $this->productTypeId = $productTypeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
