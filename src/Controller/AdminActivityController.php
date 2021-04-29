<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    // delete
    public const MAX_FIELD_LENGTH = 255;
    public const MIN_FIELD_LENGTH = 2;

    public function edit($id): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectOneById($id);
        $errors = [];

        if (!$activities) {
            $errors[] = "Cette activité n'existe pas";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = array_map('trim', $_POST);
            $activities = array_map('ucfirst', $activities);

            // TODO validations (length, format...)

            $errorsEmpty = $this->validateEmpty($activities);
            $errorsLength = $this->validateLength($activities);
            $errorsURL = $this->validateURL($activities);
            $errorsTime = $this->validateTime($activities);
            $errors = array_merge($errorsEmpty, $errorsLength, $errorsURL, $errorsTime);

            if (empty($errors)) {
                $activityManager = new ActivityManager();
                $activities['id'] = $id;
                $activityManager->update($activities);
                header('Location: /AdminActivity/index');
            }
        }
        return $this->twig->render('Admin/Activity/edit.html.twig', [
            'activity' => $activities, 'errors' => $errors,
        ]);
    }
    // Delete everything past this before committing

    public function validateEmpty(array $activities): array
    {
        $errorsEmpty = [];
        if (empty($activities['name'])) {
            $errorsEmpty[] = "Le nom de l'activité est obligatoire.";
        }

        if (empty($activities['weekday'])) {
            $errorsEmpty[] = "Vous devez indiquer le jour.";
        }

        if (empty($activities['instructor_name'])) {
            $errorsEmpty[] = "Le nom de l'animateur est obligatoire";
        }

        if (empty($activities['start_time'])) {
            $errorsEmpty[] = "Veuillez indiquer une heure de début pour cette activité";
        }

        if (empty($activities['end_time'])) {
            $errorsEmpty[] = "Veuillez indiquer une heure de début pour cette activité";
        }

        return $errorsEmpty;
    }

    //Delete everything past this before pushing

    public function validateURL(array $activities): array
    {
        $errorsURL = [];

        if (empty(!$activities['image'])) {
            if (!filter_var($activities['image'], FILTER_VALIDATE_URL)) {
                $errorsURL[] = "Cette URL n'est pas valide.";
            }
        }

        return $errorsURL;
    }

    public function validateTime(array $activities): array
    {
        $errorsTime = [];

        if ($activities['start_time'] > $activities['end_time']) {
            $errorsTime[] = 'L\'heure de fin de l\'activité doit être postérieure à l\'heure de début.';
        }

        return $errorsTime;
    }

    public function validateLength(array $activities): array
    {
        $errorsLength = [];

        if (strlen($activities['name']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom de l\'activité ne peut pas dépasser ' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor_name']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom du moniteur ne peut pas dépasser ' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['image']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'L\'url de l\' image ne peut pas dépasser ' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['description']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'La description de l\'activité ne peut pas dépasser ' . self::MAX_FIELD_LENGTH .
                ' caractères';
        }

        if (strlen($activities['name']) < self::MIN_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom de l\'activité doit faire plus de ' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor_name']) < self::MIN_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom du moniteur doit faire plus de ' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        return $errorsLength;
    }
}
