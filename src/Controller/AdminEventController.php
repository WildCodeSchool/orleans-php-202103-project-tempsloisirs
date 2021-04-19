<?php

namespace App\Controller;

use App\Model\EventsManager;

class AdminEventController extends AbstractController
{


    public function index(): string
    {
        $eventsManager = new EventsManager();
        $events = $eventsManager->selectAll();
        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }

    public function add(): string
    {
        return $this->twig->render('Admin/Event/add.html.twig');
    }
}
