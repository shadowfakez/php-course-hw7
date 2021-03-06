<?php

namespace builder;

use Aigletter\Interfaces\Builder\BuilderInterface;
use Aigletter\Interfaces\Builder\SqlBuilderInterface;

class SqlBuilder implements SqlBuilderInterface
{
    public array|string $columns;
    public array|string $conditions;
    public string $table;
    public int $limit;
    public int $offset;
    public array $order;

    private array $query = [];

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

    /**
     * @return string
     */
    public function build(): string
    {
        ksort($this->query);
        return implode('', $this->query);
    }
}