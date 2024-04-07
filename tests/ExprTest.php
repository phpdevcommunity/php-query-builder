<?php

namespace Test\DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\Expression\Expr;
use PHPUnit\Framework\TestCase;

class ExprTest extends TestCase
{
    public function testEqual()
    {
        $this->assertEquals('id = 1', Expr::equal('id', '1'));
    }

    public function testNotEqual()
    {
        $this->assertEquals('name <> John', Expr::notEqual('name', 'John'));
    }

    public function testGreaterThan()
    {
        $this->assertEquals('quantity > 10', Expr::greaterThan('quantity', '10'));
    }

    public function testGreaterThanEqual()
    {
        $this->assertEquals('price >= 100', Expr::greaterThanEqual('price', '100'));
    }

    public function testLowerThan()
    {
        $this->assertEquals('age < 30', Expr::lowerThan('age', '30'));
    }

    public function testLowerThanEqual()
    {
        $this->assertEquals('score <= 80', Expr::lowerThanEqual('score', '80'));
    }

    public function testIsNull()
    {
        $this->assertEquals('description IS NULL', Expr::isNull('description'));
    }

    public function testIsNotNull()
    {
        $this->assertEquals('status IS NOT NULL', Expr::isNotNull('status'));
    }

    public function testIn()
    {
        $this->assertEquals('category IN (1, 2, 3)', Expr::in('category', [1, 2, 3]));
    }

    public function testNotIn()
    {
        $this->assertEquals("color NOT IN ('red', 'blue')", Expr::notIn('color', ['red', 'blue']));
    }
}