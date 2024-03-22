<?php

namespace Domain\Entity;

use Domain\Validation\DomainValidation;

class ProductType
{

    private ?int $id = 0;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;

        $this->validateName();
    }

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

    private function validateName()
    {
        DomainValidation::strMaxLength($this->name, 100);
        DomainValidation::strMinLength($this->name, 2);
    }
}
