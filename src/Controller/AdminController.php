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

    public function addBoardMember()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $boardMember = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $adminManager = new AdminManager();
            $adminManager->insert($boardMember);
            header('Location:/admin/board/');
        }

        return $this->twig->render('Admin/board_add.html.twig');
    }
}
