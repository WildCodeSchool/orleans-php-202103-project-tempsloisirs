<?php

namespace App\Controller;

use App\Model\EventManager;
use DateTime;

class EventController extends AbstractController
{

    public function index(): string
    {
        $monthId = (new DateTime())->format('n');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $month = array_map('intval', $_POST);
            $monthId = $month['monthId'];
        }

        $eventManager = new EventManager();
        $events = $eventManager->selectByMonth($monthId);

        return $this->twig->render('Home/event.html.twig', [
            'monthId' => $monthId,
            'events' => $events,
        ]);
    }
}
