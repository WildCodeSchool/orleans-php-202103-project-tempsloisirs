<?php

namespace App\Model;

class HomeManager extends AbstractManager
{

    public function selectInfo(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT * FROM information";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectEvent(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT * FROM event";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectActivity(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT * FROM activity";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectPhoto(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = "SELECT * FROM photo";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
