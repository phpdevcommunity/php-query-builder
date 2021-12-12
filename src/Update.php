<?php

namespace DevCoder;

use DevCoder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
class Update implements QueryInterface
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var array<string>
     */
    private $conditions = [];

    /**
     * @var array<string>
     */
    private $columns = [];

    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $alias === null ? $table : "${table} AS ${alias}";;
    }

    public function __toString(): string
    {
        return 'UPDATE ' . $this->table
            . ' SET ' . implode(', ', $this->columns)
            . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
    }

    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    public function set(string $key, string $value): self
    {
        $this->columns[] = $key . ' = ' . $value;
        return $this;
    }
}
