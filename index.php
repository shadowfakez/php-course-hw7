<?php

use builder\Db;
use builder\Query;
use builder\QueryBuilder;
use builder\SqlBuilder;

require_once __DIR__ . '/vendor/autoload.php';


//Level 1
/*$builder = new SqlBuilder();

echo $builder->table('users')
    ->select(['first_name', 'age'])
    ->where(['status' => 'active'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40)
    ->build();

echo PHP_EOL;*/

//Level 2

/*$builder = new QueryBuilder();

$query = $builder
    ->table('users')
    ->select(['first_name', 'age'])
    ->where(['status' => 'active'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40)
    ->build();

echo $sql = (string) $query->toSql();

echo PHP_EOL;*/

//Level 3

$builder = new QueryBuilder();

$builder
    ->table('users')
    ->select(['first_name', 'age'])
    ->where(['id' => 3])
    ->build();

$db = new Db();

$query = new Query($builder);

$user = $db->one($query);
$users = $db->all($query);

print_r($user);
print_r($users);


