<?php

namespace DevCoder;

use DevCoder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
class Delete implements QueryInterface
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var array<string>
     */
    private $conditions = [];

    public function __construct(string $table, ?string $alias = null)
    {
        $this->table = $alias === null ? $table : "${table} AS ${alias}";;
    }

    public function __toString(): string
    {
        return 'DELETE FROM ' . $this->table . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions));
    }

    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }
}
