<?php

namespace App\Model;

class ActivityManager extends AbstractManager
{
    public const TABLE = 'activity';

    /**
     * Insert new item in database
     */
    public function insert(array $activity)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`name`,`weekday`, `instructor_name`, `start_time`, `end_time`, `image`, `description`) 
        VALUES (:name, :weekday, :instructor_name, :start_time, :end_time, :image, :description)");
        $statement->bindValue('name', $activity['name'], \PDO::PARAM_STR);
        $statement->bindValue('weekday', $activity['weekday'], \PDO::PARAM_STR);
        $statement->bindValue('instructor_name', $activity['instructor_name'], \PDO::PARAM_STR);
        $statement->bindValue('start_time', $activity['start_time'], \PDO::PARAM_STR);
        $statement->bindValue('end_time', $activity['end_time'], \PDO::PARAM_STR);
        $statement->bindValue('image', $activity['image'], \PDO::PARAM_STR);
        $statement->bindValue('description', $activity['description'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function update(array $activities): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name WHERE id=:id");
        $statement->bindValue('id', $activities['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $activities['name'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
