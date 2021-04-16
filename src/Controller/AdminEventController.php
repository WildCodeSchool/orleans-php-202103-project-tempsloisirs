<?php

namespace App\Controller;

use App\Model\EventsManager;

class AdminEventController extends AbstractController
{

    private EventsManager $eventsManager;


    public function index(): string
    {
        return $this->twig->render('Admin/Event/index.html.twig');
    }

    public function add(): string
    {
        return $this->twig->render('Admin/Event/add.html.twig');
    }


    public function browseEvents(): void
    {
        $this->eventsManager->selectAll();
    }
}
