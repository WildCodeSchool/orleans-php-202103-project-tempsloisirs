<?php

namespace App\Controller;

use App\Model\BoardManager;

class AboutController extends AbstractController
{
    public function index()
    {
        $boardManager = new BoardManager();
        $boardMembers = $boardManager->selectAll('firstname');

        return $this->twig->render('About/index.html.twig', ['boardMembers' => $boardMembers]);
    }
}
