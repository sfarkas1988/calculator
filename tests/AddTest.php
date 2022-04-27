<?php

namespace App\Tests;

use App\Model\Calculator;
use App\Service\Add;
use PHPUnit\Framework\TestCase;

class AddTest extends TestCase
{
    public function testAdd(): void
    {
        $calculator = new Calculator();
        $calculator->setNumber1(1);
        $calculator->setNumber2(5);

        $add = new Add();
        $this->assertEquals(6, $add->calculate($calculator)->getResult());
    }
}
