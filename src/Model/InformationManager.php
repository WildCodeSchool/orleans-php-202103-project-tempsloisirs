<?php

namespace App\Model;

class InformationManager extends AbstractManager
{
    public const TABLE = 'information';

    public function insert(array $informations): void
    {
        $query = "INSERT INTO " . self::TABLE . " (`date`, `type`, `content`) VALUES (:date,:type ,:content)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('date', $informations['date'], \PDO::PARAM_STR);
        $statement->bindValue('type', $informations['type'], \PDO::PARAM_STR);
        $statement->bindValue('content', $informations['content'], \PDO::PARAM_STR);

        $statement->execute();
    }
}