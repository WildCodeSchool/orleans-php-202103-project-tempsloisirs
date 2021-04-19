<?php

namespace App\Controller;

use App\Model\AdminBoardManager;

class AdminBoardController extends AbstractController
{
    /**
     * Show informations for a specific item
     */
    public function index(): string
    {
        $adminManager = new AdminBoardManager();
        $boardMembers = $adminManager->selectAll('firstname');

        return $this->twig->render('Admin/Board/index.html.twig', ['boardMembers' => $boardMembers]);
    }
}
