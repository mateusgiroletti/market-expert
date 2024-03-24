<?php

namespace Domain\Entity;

class SaleProduct
{
    private ?int $id = 0;
    private int $saleId;
    private int $productId;
    private int $amount;
    private float $subtotal;
    private float $totalTax;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSaleId(): float
    {
        return $this->saleId;
    }

    public function setSaleId(int $saleId): void
    {
        $this->saleId = $saleId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    public function getTotalTax(): float
    {
        return $this->totalTax;
    }

    public function setTotalTax(float $totalTax): void
    {
        $this->totalTax = $totalTax;
    }
}
