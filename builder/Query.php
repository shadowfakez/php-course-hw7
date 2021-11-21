<?php

namespace builder;

use Aigletter\Interfaces\Builder\BuilderInterface;
use Aigletter\Interfaces\Builder\QueryInterface;

class Query implements QueryInterface
{
    protected array|string $columns;
    protected array $conditions = [];
    protected string $table;
    protected ?int $limit = null;
    protected ?int $offset = null;
    protected array $order = [];

    protected object $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
        $this->conditions = $builder->conditions;
        $this->table = $builder->table;
        $this->columns = $builder->columns;
        $this->limit = $builder->limit;
        $this->offset = $builder->offset;
        $this->order = $builder->order;
    }

    /**
     * @return string
     */
    public function toSql(): string
    {
        ksort($this->builder->query);
        return implode('', $this->builder->query);
    }
}