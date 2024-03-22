<?php

namespace Domain\Entity;

use Domain\Validation\DomainValidation;

class ProductType
{
    protected int $id;
    protected static int $lastId = 0;
    protected string $name;

    public function __construct(
        int $id = null,
        string $name
    ) {
        $this->id = $id ?: ++$this::$lastId;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    protected function validate()
    {
        DomainValidation::strMaxLength($this->name, '100');
        DomainValidation::strMinLength($this->name, '2');
    }
}
