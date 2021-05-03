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

    public function filterByMonth(string $monthId) : string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $month = array_map('intval', $_POST);
            $month['monthId'] = $monthId;
        }

        return $this->twig->render('Home/event.html.twig', [
            'monthId' => $monthId,
            'events' => $events,
        ]);

    }

}
