<?php

namespace App\Service;

use App\Model\Calculator;
use App\Model\CalculatorResult;
use InvalidArgumentException;

class CalculatorFactory
{
    public function __construct(private Add $add, private Subtract $subtract, private Multiply $multiply, private Divide $divide)
    {
    }

    public function calculate(Calculator $calculator): CalculatorResult
    {
        $calculatorClass = null;
        switch ($calculator->getOperator()) {
            case '+':
                $calculatorClass = $this->add;
                break;
            case '-':
                $calculatorClass = $this->subtract;
                break;
            case '*':
                $calculatorClass = $this->multiply;
                break;
            case '/':
                $calculatorClass = $this->divide;
                break;
            default:
                throw new InvalidArgumentException(sprintf('Invalid operator %s', $calculator->getOperator()));
        }

        return $calculatorClass->calculate($calculator);
    }
}
