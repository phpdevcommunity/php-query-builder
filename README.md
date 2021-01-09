# php-query-builder

*PHP version required 7.3*

#Building SQL Queries with Query Builder

**How to use ?**
```php
$query = (new QueryBuilder())
->select('email', 'first_name', 'last_name')
->from('user');

$pdoStatement = $pdo->prepare($query);
$pdoStatement->execute();

$users = $pdoStatement->fetchAll(\PDO::FETCH_ASSOC);
```
```php
$query = (new QueryBuilder())
->select('u.email', 'u.first_name', 'u.last_name', 'u.active')
->from('user', 'u')
->where('u.email = :email', 'u.active = :bool');

$pdoStatement = $pdo->prepare($query);
$pdoStatement->execute([
    'email' => 'dev@devcoder.xyz', 
    'bool' => 1
    ]
);

$user = $pdoStatement->fetch(\PDO::FETCH_ASSOC);
```
Ideal for small project
Simple and easy!
