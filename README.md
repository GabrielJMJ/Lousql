Lousql
=======
In-development.

## Usage example
Creating table
```php
use Gabrieljmj\Lousql\Builder\Builder;

$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
$builder = new Builder();
$table = 
    $buiilder
        ->createTable('users')
            ->ifNotExists()
            ->id
                ->integer(11)
                ->notNull()
                ->autoIncrement()
            ->done()
            ->name
                ->varchar(50)
                ->notNull()
            ->done()
            ->created_at
                ->timestamp()
                ->asDefault('CURRENT_TIMESTAMP')
            ->done();

$pdo->exec($table);
$hasError = (int) $pdo->errorInfo()[0] === 0 ? false : true;

if ($hasError) {
    throw new \Exception($pdo->errorInfo()[2]);
}
```
Dropping table
```php
$drop = 
    $builder
        ->dropTable('users')
            ->ifExists();

$pdo->exec($drop);
```
More than one
```php
$buiilder
        ->createTable('users')
            ->ifNotExists()
            ->id
                ->integer(11)
                ->notNull()
                ->autoIncrement()
            ->done()
            ->name
                ->varchar(50)
                ->notNull()
            ->done()
            ->created_at
                ->timestamp()
                ->asDefault('CURRENT_TIMESTAMP')
            ->done()
        ->done()
        ->dropTable('posts')
            ->ifExists();

$queries = array_map(function ($query) {
    return (string) $query;
}, $builder->getQueries());

$pdo->exec(implode("\n", $queries));
```