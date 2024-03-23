<?php

namespace Domain\Entity;

class ProductTypeTaxes
{
    private ?int $id = 0;
    private int $productTypeId;
    private int $percentual;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductTypeId(): int
    {
        return $this->productTypeId;
    }

    public function setProductTypeId(int $productTypeId): void
    {
        $this->productTypeId = $productTypeId;
    }

    public function getPercentual(): int
    {
        return $this->percentual;
    }

    public function setPercentual(int $percentual): void
    {
        $this->percentual = $percentual;
    }
}
