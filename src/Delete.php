<?php

namespace DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 *  Represents a DELETE query builder.
 */
final class Delete implements QueryInterface
{
    private string $table;
    private array $conditions = [];

    /**
     *
     * @param string $table The table name
     * @param string|null $alias The table alias (optional)
     */
    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $alias === null ? $table : "${table} AS ${alias}";;
    }

    /**
     * Get the string representation of the DELETE query.
     *
     * @return string
     */
    public function __toString(): string
    {
        if (empty($this->table)) {
            throw new \LogicException('No table to delete from');
        }

        return 'DELETE FROM ' . $this->table . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
    }

    /**
     * Add WHERE conditions to the DELETE query.
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
}
