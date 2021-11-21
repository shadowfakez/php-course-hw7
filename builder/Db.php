<?php

namespace builder;

use Aigletter\Interfaces\Builder\DbInterface;
use Aigletter\Interfaces\Builder\QueryInterface;
use PDO;
use PDOException;

class Db implements DbInterface
{

    /**
     * @param QueryInterface $query
     * @return object
     */
    public function one(QueryInterface $query): object
    {
        try {
            $conn = new PDO('mysql:dbname=test;host=localhost', 'root', '142536');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $db = $conn->prepare($query->toSql());
        $db->execute();
        return $db->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param QueryInterface $query
     * @return object[]
     */
    public function all(QueryInterface $query): array
    {
        try {
            $conn = new PDO('mysql:dbname=test;host=localhost', 'root', '142536');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $db = $conn->prepare("SELECT * FROM users");
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }
}