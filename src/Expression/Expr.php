<?php

namespace DevCoder\SqlBuilder\Expression;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
final class Expr
{
    /**
     * Returns an SQL expression for equal comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function equal(string $key, string $value): string
    {
        return "$key = $value";
    }

    /**
     * Returns an SQL expression for not equal comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function notEqual(string $key, string $value): string
    {
        return "$key <> $value";
    }

    /**
     * Returns an SQL expression for greater than comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function greaterThan(string $key, string $value): string
    {
        return "$key > $value";
    }

    /**
     * Returns an SQL expression for greater than or equal comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function greaterThanEqual(string $key, string $value): string
    {
        return "$key >= $value";
    }

    /**
     * Returns an SQL expression for lower than comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function lowerThan(string $key, string $value): string
    {
        return "$key < $value";
    }

    /**
     * Returns an SQL expression for lower than or equal comparison.
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    public static function lowerThanEqual(string $key, string $value): string
    {
        return "$key <= $value";
    }

    /**
     * Returns an SQL expression for checking if a column is NULL.
     *
     * @param string $key
     * @return string
     */
    public static function isNull(string $key): string
    {
        return "$key IS NULL";
    }

    /**
     * Returns an SQL expression for checking if a column is NOT NULL.
     *
     * @param string $key
     * @return string
     */
    public static function isNotNull(string $key): string
    {
        return "$key IS NOT NULL";
    }

    /**
     * Returns an SQL expression for checking if a value is in a list of values.
     *
     * @param string $key
     * @param array $values
     * @return string
     */
    public static function in(string $key, array $values): string
    {
        $values = array_map(function ($val) {
            if (strpos($val, ':') === 0 || $val === '?') {
                return $val;
            }

            if (is_string($val)) {
                return "'$val'";
            }

            return $val;
        }, $values);

        return "$key IN " . '(' . implode(', ', $values) . ')';
    }

    /**
     * Returns an SQL expression for checking if a value is not in a list of values.
     *
     * @param string $key
     * @param array $values
     * @return string
     */
    public static function notIn(string $key, array $values): string
    {
        $values = array_map(function ($val) {
            if (strpos($val, ':') === 0 || $val === '?') {
                return $val;
            }

            if (is_string($val)) {
                return "'$val'";
            }

            return $val;
        }, $values);

        return "$key NOT IN (" . implode(', ', $values) . ')';
    }
}
