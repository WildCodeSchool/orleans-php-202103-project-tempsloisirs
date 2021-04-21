<?php

namespace App\Model;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';

    public function saveEvent(array $event)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`name`, `start_date`, `end_date`, `price`, `image`, `description`) 
        VALUES (:name, :start_date, :end_date, :price, :image, :description)");
        $statement->bindValue('name', $event['name'], \PDO::PARAM_STR);
        $statement->bindValue('start_date', $event['start_date'], \PDO::PARAM_STR);
        // Binding value if it exists or if it is null
        $statement->bindValue('end_date', $event['end_date'] ? $event : null, \PDO::PARAM_STR);
        $statement->bindValue('price', $event['price'], \PDO::PARAM_STR);
        $statement->bindValue('image', $event['image'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
