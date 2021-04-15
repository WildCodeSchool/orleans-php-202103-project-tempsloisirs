<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    public const TABLE = 'board';

    public function insert(array $boardMember)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`image`, `firstname`, `surname`, `role`) VALUES (:image, :firstname, :surname, :role)");
        $statement->bindValue('image', $boardMember['image'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $boardMember['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('surname', $boardMember['surname'], \PDO::PARAM_STR);
        $statement->bindValue('role', $boardMember['role'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
