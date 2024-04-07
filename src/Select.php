<?php

namespace DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
/**
 * Class Select
 * Represents a SELECT query builder.
 */
final class Select implements QueryInterface
{
    /**
     * @var array List of fields to select
     */
    private array $fields = [];

    /**
     * @var array List of conditions for WHERE clause
     */
    private array $conditions = [];

    /**
     * @var array List of order fields for ORDER BY clause
     */
    private array $order = [];

    /**
     * @var array List of tables for FROM clause
     */
    private array $from = [];

    /**
     * @var array List of fields to group by
     */
    private array $groupBy = [];

    /**
     * @var array List of conditions for HAVING clause
     */
    private array $having = [];

    /**
     * @var ?int Limit for the query
     */
    private ?int $limit = null;

    /**
     * @var bool Indicates if DISTINCT should be used
     */
    private bool $distinct = false;

    /**
     * @var array List of JOIN clauses
     */
    private array $join = [];

    /**
     * Select constructor.
     * @param array $select Initial fields to select
     */
    public function __construct(array $select)
    {
        $this->fields = $select;
    }

    /**
     * Add fields to select
     * @param string ...$select List of fields to select
     * @return $this
     */
    public function select(string ...$select): self
    {
        foreach ($select as $arg) {
            $this->fields[] = $arg;
        }
        return $this;
    }

    /**
     * Build the string representation of the query
     * @return string
     */
    public function __toString(): string
    {
        if ($this->from === []) {
            throw new \LogicException('No table specified');
        }

        return trim('SELECT ' . ($this->distinct === true ? 'DISTINCT ' : '') . implode(', ', $this->fields)
            . ' FROM ' . implode(', ', $this->from)
            . ($this->join === [] ? '' : ' '.implode(' ', $this->join))
            . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions))
            . ($this->groupBy === [] ? '' : ' GROUP BY ' . implode(', ', $this->groupBy))
            . ($this->having === [] ? '' : ' HAVING ' . implode(' AND ', $this->having))
            . ($this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order))
            . ($this->limit === null ? '' : ' LIMIT ' . $this->limit));
    }

    /**
     * Add conditions for the WHERE clause
     * @param string ...$where List of conditions
     * @return $this
     */
    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    /**
     * Set the table for the FROM clause
     * @param string $table Table name
     * @param string|null $alias Optional table alias
     * @return $this
     */
    public function from(string $table, ?string $alias = null): self
    {
        $this->from[] = $alias === null ? $table : "${table} AS ${alias}";
        return $this;
    }

    /**
     * Set the limit for the query
     * @param int $limit Limit value
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Add order fields for the ORDER BY clause
     * @param string $sort Field to sort by
     * @param string $order Sorting order (ASC or DESC)
     * @return $this
     */
    public function orderBy(string $sort, string $order = 'ASC'): self
    {
        $this->order[] = "$sort $order";
        return $this;
    }

    /**
     * Add INNER JOIN clause
     * @param string ...$join List of tables to join
     * @return $this
     */
    public function innerJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "INNER JOIN $arg";
        }
        return $this;
    }

    /**
     * Add LEFT JOIN clause
     * @param string ...$join List of tables to join
     * @return $this
     */
    public function leftJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "LEFT JOIN $arg";
        }
        return $this;
    }

    /**
     * Perform a right join with the given tables.
     *
     * @param string ...$join The tables to perform right join with
     * @return self
     */
    public function rightJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "RIGHT JOIN $arg";
        }
        return $this;
    }

    /**
     * Set the query to return distinct results.
     *
     * @return self
     */
    public function distinct(): self
    {
        $this->distinct = true;
        return $this;
    }

    /**
     * Group the query results by the given columns.
     *
     * @param string ...$groupBy The columns to group by
     * @return self
     */
    public function groupBy(string ...$groupBy): self
    {
        foreach ($groupBy as $arg) {
            $this->groupBy[] = $arg;
        }
        return $this;
    }

    /**
     * Set the HAVING clause for the query.
     *
     * @param string ...$having The conditions for the HAVING clause
     * @return self
     */
    public function having(string ...$having): self
    {
        foreach ($having as $arg) {
            $this->having[] = $arg;
        }
        return $this;
    }
}
