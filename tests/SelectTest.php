<?php

namespace Test\DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\QueryBuilder;
use DevCoder\SqlBuilder\Select;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase
{
    public function testToStringOnlyReturnsSqlString()
    {
        $select = new Select(['field1']);
        $select->from('table1', 't1');
        $select->where('condition1', 'condition2');
        $select->groupBy('groupField');

        $expectedSql = 'SELECT field1 FROM table1 AS t1 WHERE condition1 AND condition2 GROUP BY groupField';

        $this->assertEquals($expectedSql, (string) $select);
    }

    public function testComplexQuery()
    {
        $select = new Select(['field1']);
        $select->from('table1', 't1');
        $select->leftJoin('table2 t2 ON t1.id = t2.t1_id');
        $select->where('condition1', 'condition2');
        $select->orderBy('field2', 'DESC');
        $select->limit(10);

        $expectedSql = 'SELECT field1 FROM table1 AS t1 LEFT JOIN table2 t2 ON t1.id = t2.t1_id WHERE condition1 AND condition2 ORDER BY field2 DESC LIMIT 10';

        $this->assertEquals($expectedSql, (string) $select);
    }

    public function testFrom()
    {
        $select = new Select(['field1']);
        $select->from('table1', 't1');
        $this->assertEquals('SELECT field1 FROM table1 AS t1', (string)$select);
    }
    public function testWhere()
    {
        $select = new Select(['field1']);
        $select->where('condition1', 'condition2');

        $this->expectException(\LogicException::class);
        $select->__toString();
    }

    public function testHaving()
    {
        $query = QueryBuilder::select('category_id', 'COUNT(*) as count')
            ->from('products')
            ->groupBy('category_id')
            ->having('COUNT(*) > 5');

        $this->assertEquals('SELECT category_id, COUNT(*) as count FROM products GROUP BY category_id HAVING COUNT(*) > 5', (string) $query);
    }

    public function testGroupBy()
    {
        $query = QueryBuilder::select('category_id', 'COUNT(*) as count')
            ->from('products')
            ->groupBy('category_id');

        $this->assertEquals('SELECT category_id, COUNT(*) as count FROM products GROUP BY category_id', (string) $query);
    }
    public function testDistinct()
    {
        $query = QueryBuilder::select('name', 'email')
            ->distinct()
            ->from('users')
            ->where('status = "active"')
            ->orderBy('name')
            ->limit(10);

        $this->assertEquals('SELECT DISTINCT name, email FROM users WHERE status = "active" ORDER BY name ASC LIMIT 10', (string) $query);
    }
}