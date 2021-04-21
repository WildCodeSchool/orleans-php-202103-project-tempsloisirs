<?php

namespace App\Controller;

use App\Model\InformationManager;

class AdminInformationController extends AbstractController
{
    /**
     * Show informations for a specific item
     */
    public function index(): string
    {
        $informationManager = new InformationManager();
        $informations = $informationManager->selectAll();

        return $this->twig->render('Admin/Information/index.html.twig', ['informations' => $informations]);
    }
}
