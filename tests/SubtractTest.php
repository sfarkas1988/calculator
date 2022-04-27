<?php

namespace App\Tests;

use App\Model\Calculator;
use App\Service\Subtract;
use PHPUnit\Framework\TestCase;

class SubtractTest extends TestCase
{
    public function testSubtract(): void
    {
        $calculator = new Calculator();
        $calculator->setNumber1(8);
        $calculator->setNumber2(3);

        $add = new Subtract();
        $this->assertEquals(5, $add->calculate($calculator)->getResult());
    }
}
