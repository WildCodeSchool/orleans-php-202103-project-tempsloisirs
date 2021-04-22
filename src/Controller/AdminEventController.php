<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();
        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }
}
