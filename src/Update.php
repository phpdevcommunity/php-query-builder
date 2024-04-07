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
 * Class Update
 *
 * Represents an UPDATE query builder
 */
final class Update implements QueryInterface
{
    private string $table;
    private array $conditions = [];
    private array $columns = [];

    /**
     * Update constructor.
     *
     * @param string $table The table name
     * @param string|null $alias The table alias (optional)
     */
    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $alias === null ? $table : "${table} AS ${alias}";
    }

    /**
     * Convert the object to a string representation
     *
     * @return string
     */
    public function __toString(): string
    {
        if (empty($this->table)) {
            throw new \LogicException('No table to update');
        }

        if (empty($this->columns)) {
            throw new \LogicException('No columns to update');
        }

        $query = 'UPDATE ' . $this->table
            . ' SET ' . implode(', ', $this->columns);

        $query = trim($query);

        if (!empty($this->conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $this->conditions);
        }

        return trim($query);
    }

    /**
     * Add WHERE conditions to the query
     *
     * @param string ...$where The conditions to add
     * @return self
     */
    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    /**
     * Set the columns to update
     *
     * @param string $key The column name
     * @param string $value The value to set
     * @return self
     */
    public function set(string $key, string $value): self
    {
        $this->columns[] = $key . ' = ' . $value;
        return $this;
    }
}
