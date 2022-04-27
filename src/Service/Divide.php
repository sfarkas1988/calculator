<?php

namespace App\Service;

use App\Model\Calculator;
use App\Model\CalculatorResult;

class Divide implements CalculatorInterface
{
    public function calculate(Calculator $calculator): CalculatorResult
    {
        if (0.0 === $calculator->getNumber2()) {
            throw new \InvalidArgumentException('Division by zero is not possible');
        }

        return new CalculatorResult($calculator->getNumber1() / $calculator->getNumber2());
    }
}
