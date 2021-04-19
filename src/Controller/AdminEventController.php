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


   /*

    public function validateEvent(array $event): array
    {
        if (empty($event['name'])) {
            $errors[] = "Vous devez mettre un nom pour l'évènement.";
        }

        if (!empty($event['name']) && strlen($event['name']) > 255) {
            $errors[] = "Le nom d'évènement doit avoir moins de 255 caracteres.";
        }

        if (empty($event['start_date'])) {
            $errors[] = "Vous devez mettre une date de début pour l'évènement.";
        }

         if (!empty($event['description']) && strlen($event['description']) > 255) {
            $errors[] = "Le nom d'évènement doit avoir moins de 255 caracteres.";
        }

        if (empty($event['price'])) {
            $errors[] = "Vous devez mettre un prix pour l'évènement.";
        }

        if ($event['price'] < 0) {
            $errors[] = "Le prix d'évènement doit être 0 (gratuit) ou plus.";
        }

        return $errors ?? [];
    }


    public function addEvent(): void
    {

        if ($_SERVER['REQUESTED_METHOD'] === 'POST')
        {
            $event = array_map('trim', $_POST);

            $errors = $this->validateEvent($event);

            if (empty($errors)) {
                $this->eventsManager->saveEvent($event);
                header('Location: /');
            }

        }

    } */
}
