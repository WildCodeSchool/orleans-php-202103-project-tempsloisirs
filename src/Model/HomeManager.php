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
}
