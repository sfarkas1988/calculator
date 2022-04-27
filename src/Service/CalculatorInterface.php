<?php

namespace App\Service;

use App\Model\Calculator;
use App\Model\CalculatorResult;

interface CalculatorInterface
{
    public function calculate(Calculator $calculator): CalculatorResult;
}
