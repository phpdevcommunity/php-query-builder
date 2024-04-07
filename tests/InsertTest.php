<?php

namespace Test\DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\Insert;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    public function testConstructor()
    {
        $insert = new Insert('my_table');
        $this->expectException(\LogicException::class);
        $insert->__toString();
    }

    public function testSetValue()
    {
        $insert = new Insert('my_table');
        $insert->setValue('column1', 'value1')->setValue('column2', 'value2');
        $this->assertEquals('INSERT INTO my_table (column1, column2) VALUES (value1, value2)', (string)$insert);
    }

}