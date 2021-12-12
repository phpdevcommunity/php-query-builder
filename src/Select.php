<?php

namespace DevCoder;

use DevCoder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
class Select implements QueryInterface
{
    /**
     * @var array<string>
     */
    private $fields = [];

    /**
     * @var array<string>
     */
    private $conditions = [];

    /**
     * @var array<string>
     */
    private $order = [];

    /**
     * @var array<string>
     */
    private $from = [];

    /**
     * @var array<string>
     */
    private $groupBy = [];

    /**
     * @var array<string>
     */
    private $having = [];

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var bool
     */
    private $distinct = false;

    /**
     * @var array
     */
    private $join = [];

    public function __construct(array $select)
    {
        $this->fields = $select;
    }

    public function select(string ...$select): self
    {
        foreach ($select as $arg) {
            $this->fields[] = $arg;
        }
        return $this;
    }

    public function __toString(): string
    {
        return trim('SELECT ' . ($this->distinct === true ? 'DISTINCT ' : '') . implode(', ', $this->fields)
            . ' FROM ' . implode(', ', $this->from)
            . ($this->join === [] ? '' :  implode(' ', $this->join))
            . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions))
            . ($this->groupBy === [] ? '' : ' GROUP BY ' . implode(', ', $this->groupBy))
            . ($this->having === [] ? '' : ' HAVING ' . implode(' AND ', $this->having))
            . ($this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order))
            . ($this->limit === null ? '' : ' LIMIT ' . $this->limit));
    }

    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    public function from(string $table, ?string $alias = null): self
    {
        $this->from[] = $alias === null ? $table : "${table} AS ${alias}";
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function orderBy(string $sort, string $order = 'ASC'): self
    {
        $this->order[] = "$sort $order";
        return $this;
    }

    public function innerJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "INNER JOIN $arg";
        }
        return $this;
    }

    public function leftJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "LEFT JOIN $arg";
        }
        return $this;
    }

    public function rightJoin(string ...$join): self
    {
        foreach ($join as $arg) {
            $this->join[] = "RIGHT JOIN $arg";
        }
        return $this;
    }

    public function distinct(): self
    {
        $this->distinct = true;
        return $this;
    }

    public function groupBy(string ...$groupBy): self
    {
        foreach ($groupBy as $arg) {
            $this->groupBy[] = $arg;
        }
        return $this;
    }

    public function having(string ...$having): self
    {
        foreach ($having as $arg) {
            $this->having[] = $arg;
        }
        return $this;
    }
}
