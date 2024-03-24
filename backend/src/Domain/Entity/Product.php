<?php

namespace Domain\Entity;

class Product
{
    private ?int $id = 0;
    private string $name;
    private float $price;
    private ?int $taxePercentual;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getTaxePercentual(): int
    {
        return $this->taxePercentual;
    }

    public function setTaxePercentual(int $taxePercentual): void
    {
        $this->taxePercentual = $taxePercentual;
    }
}
