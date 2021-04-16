<?php

namespace App\Model;

use PDO;

class EventsManager extends AbstractManager
{
    public const TABLE = 'event';

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        $events = $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $events;
    }

    public function getEventById(int $id)
    {

        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE  . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $event = $statement->fetch(PDO::FETCH_ASSOC);
        return $event;
    }
}
