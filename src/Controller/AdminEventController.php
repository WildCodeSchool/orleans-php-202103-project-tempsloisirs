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

    public function add()
    {
        $errorsDateValue = $errorsEmptyLength = $event = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);

            $errorsEmptyLength = $this->validateEmptyLength($event);
            $errorsDateValue = $this->validateDateValue($event);

            if (empty($errorsEmptyLength) && empty($errorsDateValue)) {
                $eventManager = new EventManager();
                $eventManager->saveEvent($event);
                header('Location:/adminEvent/index');
            }
        }
        return $this->twig->render('Admin/Event/add.html.twig', [
            'errorsEmptyLength' => $errorsEmptyLength,
            'errorsDateValue' => $errorsDateValue,
            'event' => $event,
        ]);
    }

    public function validateEmptyLength($event)
    {
        $errorsEmptyLength = [];
        if (empty($event['name'])) {
            $errorsEmptyLength[] = "Vous devez mettre un nom pour l'évènement.";
        }

        if (!empty($event['name']) && strlen($event['name']) > self::MAX_FIELD_LENGTH) {
            $errorsEmptyLength[] = "Le nom d'évènement doit avoir moins de " . self::MAX_FIELD_LENGTH . " caracteres.";
        }

        if (empty($event['start_date'])) {
            $errorsEmptyLength[] = "Vous devez mettre une date de début pour l'évènement.";
        }

        if (!empty($event['description']) && strlen($event['description']) > self::MAX_FIELD_LENGTH) {
            $errorsEmptyLength[] = "Le nom d'évènement doit avoir moins de " . self::MAX_FIELD_LENGTH . " caracteres.";
        }

        if (empty($event['price'])) {
            $errorsEmptyLength[] = "Vous devez mettre un prix pour l'évènement.";
        }
        return $errorsEmptyLength ?? [];
    }

    public function validateDateValue($event)
    {

        $errorsDateValue = [];

        if (empty($event['start_date'])) {
            $errorsDateValue[] = "Vous devez mettre une date de début pour l'évènement.";
        }

        if ($event['start_date'] < date("Y-m-d")) {
            $errorsDateValue[] = "L'événement ne peut pas avoir lieu à une date passée.";
        }

        if (isset($event['end_date']) < $event['start_date']) {
            $errorsDateValue[] = "La date de fin de l'événement ne peut pas être précédent à date de début.";
        }

        if ($event['price'] < 0) {
            $errorsDateValue[] = "Le prix d'évènement doit être 0 (gratuit) ou plus.";
        }

        return $errorsDateValue ?? [];
    }
}
