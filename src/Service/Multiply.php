<?php

namespace App\Service;

use App\Model\Calculator;
use App\Model\CalculatorResult;

class Multiply implements CalculatorInterface
{
    public function calculate(Calculator $calculator): CalculatorResult
    {
        return new CalculatorResult($calculator->getNumber1() * $calculator->getNumber2());
    }
}
