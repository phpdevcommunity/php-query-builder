<?php

namespace DevCoder;

use DevCoder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
class Insert implements QueryInterface
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var array<string>
     */
    private $values = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function __toString(): string
    {
        return 'INSERT INTO ' . $this->table
            . ' (' . implode(', ',array_keys($this->values)) . ') VALUES (' . implode(', ',$this->values) . ')';
    }

    public function setValue(string $column, string $value): self
    {
        $this->values[$column] = $value;
        return $this;
    }
}
