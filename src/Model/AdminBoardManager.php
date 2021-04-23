<?php

namespace App\Model;

class AdminBoardManager extends AbstractManager
{
    public const TABLE = 'board';

    /**
     * Update item in database
     */
    public function update(array $boardMember): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `firstname` = :firstname, `surname` = :surname, `role` = :role, `image` = :image WHERE id=:id");
        $statement->bindValue('id', $boardMember['id'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $boardMember['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('surname', $boardMember['surname'], \PDO::PARAM_STR);
        $statement->bindValue('role', $boardMember['role'], \PDO::PARAM_STR);
        $statement->bindValue('image', $boardMember['image'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function insert(array $boardMember)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`firstname`, `surname`, `role`, `image`) VALUES (:firstname, :surname, :role, :image)");
        $statement->bindValue('firstname', $boardMember['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('surname', $boardMember['surname'], \PDO::PARAM_STR);
        $statement->bindValue('role', $boardMember['role'], \PDO::PARAM_STR);
        $statement->bindValue('image', $boardMember['image'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
