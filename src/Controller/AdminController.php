<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    /**
     * Show informations for a specific item
     */
    public function board(): string
    {
        $adminManager = new AdminManager();
        $boardMembers = $adminManager->selectAll('firstname');

        return $this->twig->render('Admin/board_index.html.twig', ['boardMembers' => $boardMembers]);
    }
}
