<?php

namespace App\Controller;

use App\Model\EventManager;

class EventController extends AbstractController
{

    public function index()
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();
        return $this->twig->render('Home/event.html.twig', ['events' => $events]);
    }
}
