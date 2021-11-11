<?php


use builder\SqlBuilder;

require_once __DIR__ . '/vendor/autoload.php';

$builder = new SqlBuilder();

$builder->table('users')
    ->select(['first_name', 'age'])
    ->where(['status' => 'active'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40);

print_r($builder);