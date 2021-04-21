<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{

    public const MAX_FIELD_LENGTH = 255;

    public function index(): string
    {
        $eventsManager = new EventManager();
        $events = $eventsManager->selectAll();
        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }


    public function delete(int $id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $eventManager = new EventManager();
            $eventManager->delete($id);

            header('Location:/adminEvent/index');
        }
    }
}
