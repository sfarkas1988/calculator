<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Calculator
{
    /**
     * @Assert\NotNull
     */
    private ?float $number1 = null;

    /**
     * @Assert\NotNull
     */
    private ?float $number2 = null;

    /**
     * @Assert\NotNull
     */
    private ?string $operator = null;

    public function getNumber1(): ?float
    {
        return $this->number1;
    }

    public function setNumber1(?float $number1): void
    {
        $this->number1 = $number1;
    }

    public function getNumber2(): ?float
    {
        return $this->number2;
    }

    public function setNumber2(?float $number2): void
    {
        $this->number2 = $number2;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator(?string $operator): void
    {
        $this->operator = $operator;
    }

    /**
     * @Assert\IsTrue(message="Division by zero is not allowed")
     */
    public function isNotDivisionByZero(): bool
    {
        return '/' !== $this->operator || $this->number2 > 0;
    }
}
