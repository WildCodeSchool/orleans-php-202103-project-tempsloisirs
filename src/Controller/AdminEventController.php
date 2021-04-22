<?php

namespace App\Controller;

use App\Model\EventManager;

class AdminEventController extends AbstractController
{

    public const MAX_FIELD_LENGTH = 255;

    public function add()
    {
        $eventManager = new EventManager();
        $errorsDateValue = $errorsEmptyLength = $event = $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);

            $errorsEmptyLength = $this->validateEmptyLength($event);
            $errorsDateValue = $this->validateDateValue($event);
            $errors = array_merge($errorsEmptyLength, $errorsDateValue);

            if (empty($errors)) {
                $eventManager->saveEvent($event);
                header('Location:/adminEvent/index');
            }
        }
        return $this->twig->render('Admin/Event/add.html.twig', [
            'errors' => $errors,
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

        if (empty($event['end_date'])) {
            $errorsDateValue[] = "Vous devez mettre une date de fin pour l'évènement.";
        }

        if ($event['start_date'] < date("Y-m-d")) {
            $errorsDateValue[] = "L'événement ne peut pas avoir lieu à une date passée.";
        }

        if ($event['end_date'] < $event['start_date']) {
            $errorsDateValue[] = "La date de fin de l'événement ne peut pas être précédent à date de début.";
        }


        if ($event['price'] < 0) {
            $errorsDateValue[] = "Le prix d'évènement doit être 0 (gratuit) ou plus.";
        }

        if (!filter_var($event['image'], FILTER_VALIDATE_URL)) {
            $errorsDateValue[] = 'L\'image doit être un URL';
        }

        return $errorsDateValue ?? [];
    }
    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll();
        return $this->twig->render('Admin/Event/index.html.twig', ['events' => $events]);
    }
}
