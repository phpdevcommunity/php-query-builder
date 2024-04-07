<?php

namespace Test\DevCoder\SqlBuilder;

use PHPUnit\Framework\TestCase;
use DevCoder\SqlBuilder\Delete;

class DeleteTest extends TestCase
{

    public function testToStringWithoutConditions()
    {
        $delete = new Delete('table_name');
        $this->assertEquals('DELETE FROM table_name', $delete->__toString());
    }

    public function testToStringWithConditions()
    {
        $delete = new Delete('table_name');
        $delete->where('condition1', 'condition2');
        $this->assertEquals('DELETE FROM table_name WHERE condition1 AND condition2', $delete->__toString());
    }

}