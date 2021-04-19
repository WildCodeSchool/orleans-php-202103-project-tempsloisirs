<?php

namespace App\Model;

class AdminBoardManager extends AbstractManager
{
    public const TABLE = 'board';

    public function insert(array $boardMember): int
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
