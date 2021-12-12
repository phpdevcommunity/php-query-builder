<?php

namespace DevCoder\Expression;

/**
 * @package	php-query-builder
 * @author	Devcoder.xyz <dev@devcoder.xyz>
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://www.devcoder.xyz
 */
class Expr
{
    public static function equal(string $key, string $value): string
    {
        return "$key = $value";
    }

    public static function notEqual(string $key, string $value): string
    {
        return "$key <> $value";
    }

    public static function greaterThan(string $key, string $value): string
    {
        return "$key > $value";
    }

    public static function greaterThanEqual(string $key, string $value): string
    {
        return "$key >= $value";
    }

    public static function lowerThan(string $key, string $value): string
    {
        return "$key < $value";
    }

    public static function lowerThanEqual(string $key, string $value): string
    {
        return "$key <= $value";
    }

    public static function isNull(string $key): string
    {
        return "$key IS NULL";
    }

    public static function isNotNull(string $key): string
    {
        return "$key IS NOT NULL";
    }

    public static function in(string $key, array $values): string
    {
        return "$key IN " . '(' . implode(', ', $values) . ')';
    }

    public static function notIn(string $key, array $values): string
    {
        return "$key NOT IN " . '(' . implode(', ', $values) . ')';
    }
}
