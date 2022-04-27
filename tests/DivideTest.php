<?php

namespace App\Tests;

use App\Model\Calculator;
use App\Service\Divide;
use PHPUnit\Framework\TestCase;

class DivideTest extends TestCase
{
    public function testMultiply(): void
    {
        $calculator = new Calculator();
        $calculator->setNumber1(5);
        $calculator->setNumber2(5);

        $add = new Divide();
        $this->assertEquals(1, $add->calculate($calculator)->getResult());
    }

    public function testDivideByZero(): void
    {
        $calculator = new Calculator();
        $calculator->setNumber1(5);
        $calculator->setNumber2(0);

        $add = new Divide();
        $this->expectException(\InvalidArgumentException::class);
        $add->calculate($calculator);
    }
}
