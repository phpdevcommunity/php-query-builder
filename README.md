# PHP SQL Query Builder

A lightweight PHP query builder for easy database interactions.

[![Latest Stable Version](http://poser.pugx.org/devcoder-xyz/php-query-builder/v)](https://packagist.org/packages/devcoder-xyz/php-query-builder) [![Total Downloads](http://poser.pugx.org/devcoder-xyz/php-query-builder/downloads)](https://packagist.org/packages/devcoder-xyz/php-query-builder) [![Latest Unstable Version](http://poser.pugx.org/devcoder-xyz/php-query-builder/v/unstable)](https://packagist.org/packages/devcoder-xyz/php-query-builder) [![License](http://poser.pugx.org/devcoder-xyz/php-query-builder/license)](https://packagist.org/packages/devcoder-xyz/php-query-builder) [![PHP Version Require](http://poser.pugx.org/devcoder-xyz/php-query-builder/require/php)](https://packagist.org/packages/devcoder-xyz/php-query-builder)

## Installation

You can install this library via [Composer](https://getcomposer.org/). Make sure your project meets the minimum PHP version requirement of 7.4 or higher.

```bash
composer require devcoder-xyz/php-query-builder
```

## Usage

The SQL Query Builder library allows you to build SQL queries fluently using an object-oriented approach. Here are some examples of usage:

### Creating a SELECT Query

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query
$query = QueryBuilder::select('name', 'email')
    ->from('users')
    ->where('status = "active"')
    ->orderBy('name')
    ->limit(10);

echo $query; // Outputs: SELECT name, email FROM users WHERE status = "active" ORDER BY name LIMIT 10
```

### Types of SQL Joins with QueryBuilder

The SQL Query Builder library supports various types of JOIN operations to combine rows from multiple tables based on a related column between them. Below are examples of different JOIN types you can use with `QueryBuilder`:

#### 1. INNER JOIN

An INNER JOIN returns records that have matching values in both tables.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with INNER JOIN
$query = QueryBuilder::select('u.name', 'a.address')
    ->from('users u')
    ->innerJoin('addresses a ON u.id = a.user_id');

echo $query; // Outputs: SELECT u.name, a.address FROM users u INNER JOIN addresses a ON u.id = a.user_id
```

#### 2. LEFT JOIN

A LEFT JOIN returns all records from the left table (first table) and the matched records from the right table (second table). If there is no match, the result is NULL on the right side.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with LEFT JOIN
$query = QueryBuilder::select('u.name', 'a.address')
    ->from('users u')
    ->leftJoin('addresses a ON u.id = a.user_id');

echo $query; // Outputs: SELECT u.name, a.address FROM users u LEFT JOIN addresses a ON u.id = a.user_id
```

#### 3. RIGHT JOIN

A RIGHT JOIN returns all records from the right table (second table) and the matched records from the left table (first table). If there is no match, the result is NULL on the left side.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with RIGHT JOIN
$query = QueryBuilder::select('u.name', 'a.address')
    ->from('users u')
    ->rightJoin('addresses a ON u.id = a.user_id');

echo $query; // Outputs: SELECT u.name, a.address FROM users u RIGHT JOIN addresses a ON u.id = a.user_id
```

### Creating a SELECT Query with DISTINCT

You can use the `distinct()` method to specify a `SELECT DISTINCT` query with QueryBuilder.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with DISTINCT using QueryBuilder
$query = QueryBuilder::select('name', 'email')
    ->distinct()
    ->from('users')
    ->where('status = "active"')
    ->orderBy('name')
    ->limit(10);

echo $query; // Outputs: SELECT DISTINCT name, email FROM users WHERE status = "active" ORDER BY name LIMIT 10
```

### Creating a SELECT Query with GROUP BY

You can use the `groupBy()` method to specify a `GROUP BY` clause with QueryBuilder.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with GROUP BY using QueryBuilder
$query = QueryBuilder::select('category_id', 'COUNT(*) as count')
    ->from('products')
    ->groupBy('category_id');

echo $query; // Outputs: SELECT category_id, COUNT(*) as count FROM products GROUP BY category_id
```

### Creating a SELECT Query with HAVING Clause

You can use the `having()` method to specify a `HAVING` clause with QueryBuilder.

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a SELECT query with HAVING using QueryBuilder
$query = QueryBuilder::select('category_id', 'COUNT(*) as count')
    ->from('products')
    ->groupBy('category_id')
    ->having('COUNT(*) > 5');

echo $query; // Outputs: SELECT category_id, COUNT(*) as count FROM products GROUP BY category_id HAVING COUNT(*) > 5
```


---

### Creating an INSERT Query

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create an INSERT query
$query = QueryBuilder::insert('users')
    ->setValue('name', '"John Doe"')
    ->setValue('email', '"john.doe@example.com"')
    ->setValue('status', '"active"');

echo $query; // Outputs: INSERT INTO users (name, email, status) VALUES ("John Doe", "john.doe@example.com", "active")
```

### Creating an UPDATE Query

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create an UPDATE query
$query = QueryBuilder::update('users')
    ->set('status', '"inactive"')
    ->where('id = 123');

echo $query; // Outputs: UPDATE users SET status = "inactive" WHERE id = 123
```

### Creating an DELETE Query

```php
use DevCoder\SqlBuilder\QueryBuilder;

// Create a DELETE query
$query = QueryBuilder::delete('users')
    ->where('status = "inactive"');

echo $query; // Outputs: DELETE FROM users WHERE status = "inactive"
```

### Creating a SELECT Query with Custom Expression

```php
use DevCoder\SqlBuilder\QueryBuilder;
use DevCoder\SqlBuilder\Expression\Expr;

// Example of a query with a custom expression
$whereClause = Expr::greaterThan('age', '18');
$query = QueryBuilder::select('name', 'email')
    ->from('users')
    ->where($whereClause);

echo $query; // Outputs: SELECT name, email FROM users WHERE age > 18
```

### List of Available Expressions (`Expr`)

Here is a comprehensive list of available static methods in the `Expr` class along with examples demonstrating their usage:

#### `Expr::equal(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate an equal comparison expression
$equalExpr = Expr::equal('age', '30');
echo "Equal Expression: $equalExpr"; // Outputs: Equal Expression: age = 30
```

#### `Expr::notEqual(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a not equal comparison expression
$notEqualExpr = Expr::notEqual('status', '"active"');
echo "Not Equal Expression: $notEqualExpr"; // Outputs: Not Equal Expression: status <> "active"
```

#### `Expr::greaterThan(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a greater than comparison expression
$greaterThanExpr = Expr::greaterThan('salary', '50000');
echo "Greater Than Expression: $greaterThanExpr"; // Outputs: Greater Than Expression: salary > 50000
```

#### `Expr::greaterThanEqual(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a greater than or equal comparison expression
$greaterThanEqualExpr = Expr::greaterThanEqual('points', '100');
echo "Greater Than or Equal Expression: $greaterThanEqualExpr"; // Outputs: Greater Than or Equal Expression: points >= 100
```

#### `Expr::lowerThan(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a lower than comparison expression
$lowerThanExpr = Expr::lowerThan('price', '50');
echo "Lower Than Expression: $lowerThanExpr"; // Outputs: Lower Than Expression: price < 50
```

#### `Expr::lowerThanEqual(string $key, string $value)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a lower than or equal comparison expression
$lowerThanEqualExpr = Expr::lowerThanEqual('quantity', '10');
echo "Lower Than or Equal Expression: $lowerThanEqualExpr"; // Outputs: Lower Than or Equal Expression: quantity <= 10
```

#### `Expr::isNull(string $key)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate an IS NULL expression
$isNullExpr = Expr::isNull('description');
echo "IS NULL Expression: $isNullExpr"; // Outputs: IS NULL Expression: description IS NULL
```

#### `Expr::isNotNull(string $key)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate an IS NOT NULL expression
$isNotNullExpr = Expr::isNotNull('created_at');
echo "IS NOT NULL Expression: $isNotNullExpr"; // Outputs: IS NOT NULL Expression: created_at IS NOT NULL
```

#### `Expr::in(string $key, array $values)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate an IN expression
$inExpr = Expr::in('category_id', [1, 2, 3]);
echo "IN Expression: $inExpr"; // Outputs: IN Expression: category_id IN (1, 2, 3)
```

#### `Expr::notIn(string $key, array $values)`

```php
use DevCoder\SqlBuilder\Expression\Expr;

// Example: Generate a NOT IN expression
$notInExpr = Expr::notIn('role', ['"admin"', '"manager"']);
echo "NOT IN Expression: $notInExpr"; // Outputs: NOT IN Expression: role NOT IN ("admin", "manager")
```

These examples demonstrate how to use each `Expr` class method to generate SQL expressions for various comparison and conditional operations. Incorporate these methods into your SQL Query Builder usage to construct complex and precise SQL queries effectively.

## Features

- Fluent generation of SELECT, INSERT, UPDATE, and DELETE queries.
- Secure SQL query building to prevent SQL injection vulnerabilities.
- Support for WHERE, ORDER BY, GROUP BY, HAVING, LIMIT, and JOIN clauses.
- Simplified methods for creating custom SQL expressions.

## License

This library is open-source software licensed under the [MIT license](LICENSE).
