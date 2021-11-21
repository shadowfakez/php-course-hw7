<?php

namespace builder;


use Aigletter\Interfaces\Builder\BuilderInterface;
use Aigletter\Interfaces\Builder\QueryBuilderInterface;

class QueryBuilder implements QueryBuilderInterface
{

    public array|string $columns;
    public array $conditions = [];
    public string $table;
    public ?int $limit = null;
    public ?int $offset = null;
    public array $order = [];

    public array $query = [];

    public function select($columns): BuilderInterface
    {
        $this->columns = $columns;
        $this->query[0] = "SELECT " . implode(', ', $this->columns) . " ";
        return $this;
    }

    public function where($conditions): BuilderInterface
    {
        $this->conditions = $conditions;
        $this->query[2] = "WHERE " . implode(', ', array_keys($this->conditions)) . "='" . implode($this->conditions) . "' ";
        return $this;
    }

    public function table($table): BuilderInterface
    {
        $this->table = $table;
        $this->query[1] = "FROM " . $this->table . " ";
        return $this;
    }

    public function limit($limit): BuilderInterface
    {
        $this->limit = $limit;
        $this->query[4] = "LIMIT " . $this->limit . " ";
        return $this;
    }

    public function offset($offset): BuilderInterface
    {
        $this->offset = $offset;
        $this->query[5] = "OFFSET " . $this->offset;
        return $this;
    }

    public function order($order): BuilderInterface
    {
        $this->order = $order;
        $this->query[3] = "ORDER BY " . implode(', ', array_keys($this->order)) . ' ' . implode($this->order) . " ";
        return $this;
    }

    public function build(): Query
    {
        return new Query($this);
    }
}