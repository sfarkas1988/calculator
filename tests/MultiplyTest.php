<?php

namespace App\Tests;

use App\Model\Calculator;
use App\Service\Multiply;
use PHPUnit\Framework\TestCase;

class MultiplyTest extends TestCase
{
    public function testMultiply(): void
    {
        $calculator = new Calculator();
        $calculator->setNumber1(5);
        $calculator->setNumber2(5);

        $add = new Multiply();
        $this->assertEquals(25, $add->calculate($calculator)->getResult());
    }
}
