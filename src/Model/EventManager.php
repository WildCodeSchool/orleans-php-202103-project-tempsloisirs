<?php

namespace App\Model;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';
    public const MONTHS = [ 1 => 'Janvier',
        2 => 'Février',
        3 => 'Mars',
        4 => 'Avril',
        5 => 'Mai',
        6 => 'Juin',
        7 => 'Juillet',
        8 => 'Aout',
        9 => 'Septembre',
        10 => 'Octobre',
        11 => 'Novembre',
        12 => 'Décembre'];

    public function updateEvent(array $event)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `name`=:name, `start_date`=:start_date, `end_date`=:end_date, 
       `price`=:price, `image`=:image, `description`=:description WHERE `id`=:id");
        $statement->bindValue('id', $event['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $event['name'], \PDO::PARAM_STR);
        $statement->bindValue('start_date', $event['start_date'], \PDO::PARAM_STR);
        $statement->bindValue('end_date', $event['end_date'], \PDO::PARAM_STR);
        $statement->bindValue('price', $event['price'], \PDO::PARAM_STR);
        $statement->bindValue('image', $event['image'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function saveEvent(array $event)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`name`, `start_date`, `end_date`, `price`, `image`, `description`) 
        VALUES (:name, :start_date, :end_date, :price, :image, :description)");

        $statement->bindValue('name', $event['name'], \PDO::PARAM_STR);
        $statement->bindValue('start_date', $event['start_date'], \PDO::PARAM_STR);
        $statement->bindValue('end_date', $event['end_date'], \PDO::PARAM_STR);
        $statement->bindValue('price', $event['price'], \PDO::PARAM_STR);
        $statement->bindValue('image', $event['image'], \PDO::PARAM_STR);
        $statement->bindValue('description', $event['description'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
