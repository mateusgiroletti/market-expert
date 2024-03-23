<?php

namespace Domain\Entity;

class Sale
{
    private ?int $id = 0;
    private float $totalPurchase;
    private float $totalTax;
    private string $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTotalPurchase(): float
    {
        return $this->totalPurchase;
    }

    public function setTotalPurchase(int $totalPurchase): void
    {
        $this->totalPurchase = $totalPurchase;
    }

    public function getTotalTax(): float
    {
        return $this->totalTax;
    }

    public function setTotalTax(float $totalTax): void
    {
        $this->totalTax = $totalTax;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
