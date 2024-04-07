<?php

namespace DevCoder\SqlBuilder;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
/**
 * Query builder class to create different types of SQL queries
 */
final class QueryBuilder
{
    /**
     * Create a new SELECT query
     *
     * @param string ...$select The columns to select
     * @return Select
     */
    public static function select(string ...$select): Select
    {
        return new Select($select);
    }

    /**
     * Create a new INSERT query
     *
     * @param string $into The table name to insert into
     * @return Insert
     */
    public static function insert(string $into): Insert
    {
        return new Insert($into);
    }

    /**
     * Create a new UPDATE query
     *
     * @param string $table The table name to update
     * @return Update
     */
    public static function update(string $table): Update
    {
        return new Update($table);
    }

    /**
     * Create a new DELETE query
     *
     * @param string $table The table name to delete from
     * @return Delete
     */
    public static function delete(string $table): Delete
    {
        return new Delete($table);
    }
}
