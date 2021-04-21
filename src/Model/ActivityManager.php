<?php

namespace App\Model;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    /**
     * Update item in database
     */
    public function update(array $activities): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name WHERE id=:id");
        $statement->bindValue('id', $activities['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $activities['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
