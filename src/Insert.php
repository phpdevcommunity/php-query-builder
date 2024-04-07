<?php

namespace DevCoder\SqlBuilder;

use DevCoder\SqlBuilder\Interfaces\QueryInterface;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
final class Insert implements QueryInterface
{
    /**
     * @var string The table name for the insert operation.
     */
    private string $table;

    /**
     * @var array The columns and values to be inserted.
     */
    private array $values = [];

    /**
     * Constructor for the Insert class.
     *
     * @param string $table The table name for the insert operation.
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Generate the SQL string for the insert operation.
     *
     * @return string The SQL string for the insert operation.
     * @throws \Exception
     */
    public function __toString(): string
    {
        if (empty($this->values)) {
            throw new \LogicException('No values to insert');
        }

        return 'INSERT INTO ' . $this->table
            . ' (' . implode(', ',array_keys($this->values)) . ') VALUES (' . implode(', ',$this->values) . ')';
    }

    /**
     * Set a column and value for the insert operation.
     *
     * @param string $column The column name.
     * @param string $value The value to be inserted.
     * @return self
     */
    public function setValue(string $column, string $value): self
    {
        $this->values[$column] = $value;
        return $this;
    }
}
