<?php

namespace DevCoder;

/**
 * Class QueryBuilder
 */
class QueryBuilder
{
    public function select(string ...$select): Select
    {
        return new Select($select);
    }

    public function insert(string $into): Insert
    {
        return new Insert($into);
    }

    public function update(string $table): Update
    {
        return new Update($table);
    }
}
