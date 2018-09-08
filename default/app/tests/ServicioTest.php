<?php
require_once '../../../vendor/autoload.php';
require_once '../models/calculator.php';

use PHPUnit\Framework\TestCase;

class ServicioTest extends TestCase
{

    public $calculator;

    public function setUp()
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }

    public function testSum()
    {
        $sum = $this->calculator->sum(1, 2);
        $this->assertEquals(3, $sum);
    }

    public function testSubstract()
    {
        $substract = $this->calculator->substract(5, 1);
        $this->assertEquals(4, $substract);
    }

    public function testPow()
    {
        $pow = $this->calculator->pow(4, 3);
        $this->assertEquals(64, $pow);
    }

    public function testDivide()
    {
        $division = $this->calculator->divide(58, 4);
        $this->assertEquals(14.5, $division);
    }

    public function testMultiply()
    {
        $multiply = $this->calculator->multiply(20, 5);
        $this->assertEquals(100, $multiply);
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->calculator = null;
    }
}
