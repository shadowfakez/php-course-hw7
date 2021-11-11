<?php

namespace builder;

use Aigletter\Interfaces\Builder\BuilderInterface;

class SqlBuilder implements BuilderInterface
{

    //“SELECT first_name, age FROM users WHERE status = ‘active’ ORDER BY id ASC LIMIT 20 OFFSET 40”

    public function select($columns): BuilderInterface
    {
        echo "SELECT " . implode(', ', $columns) . " ";
        return $this;
    }

    public function where($conditions): BuilderInterface
    {
        echo "WHERE " . implode(', ', array_keys($conditions)) . '=`' . implode($conditions) . "` ";
        return $this;
    }

    public function table($table): BuilderInterface
    {
        echo "FROM " . $table . " ";
        return $this;
    }

    public function limit($limit): BuilderInterface
    {
        echo "LIMIT " . $limit . " ";
        return $this;
    }

    public function offset($offset): BuilderInterface
    {
        echo "OFFSET " . $offset . " ";
        return $this;
    }

    public function order($order): BuilderInterface
    {
        echo "ORDER BY " . implode(', ', array_keys($order)) . ' ' . implode($order) . " ";
        return $this;
    }
}