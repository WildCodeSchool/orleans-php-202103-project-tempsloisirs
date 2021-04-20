<?php

namespace App\Model;

class AdminActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    /**
     * Insert new item in database
     */
    public function insert(array $activity)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $activity['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
