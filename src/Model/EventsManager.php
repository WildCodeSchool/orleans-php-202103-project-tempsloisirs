<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

class EventsManager extends AbstractManager
{
    public const TABLE = 'events';
    public function getEventById(int $id)
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE  . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $event = $statement->fetch(PDO::FETCH_ASSOC);
        return $event;
    }
  /*   public function saveEvent(array $event): void
    {
        $query =
        'INSERT INTO events(name, start_date, end_date, price, image, description)
        VALUES (:name, :start_date, :end_date, :price, :image, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':name', $event['name'], PDO::PARAM_STR);
        $statement->bindValue('')

    }

    public function updateEvent(array $event): void
    {

    } */
}
