<?php

namespace DevCoder;

/**
 * Class QueryBuilder
 */
class QueryBuilder
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
    private $order;

    /**
     * @var array<string>
     */
    private $from = [];

    /**
     * @var int
     */
    private $limit;

    public function __toString(): string
    {
        return 'SELECT ' . implode(', ', $this->fields)
        . ' FROM ' . implode(', ', $this->from)
        . $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions)
        . $this->order === [] ? '' : ' ORDER BY ' . implode(', ', $this->order)
        . $this->limit === null ? '' : ' LIMIT ' . $this->limit;
    }

    public function select(string ...$select): self
    {
        $this->fields = $select;
        return $this;
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

    public function orderBy(string ...$order): self
    {
        foreach ($order as $arg) {
            $this->order[] = $arg;
        }
        return $this;
    }
}
