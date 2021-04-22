<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    public const MAX_FIELD_LENGTH = 255;
    public const MIN_FIELD_LENGTH = 1;

    /**
     * Add a new item
     */
    public function add(): string
    {
        $errors = [];
        $errorsLength = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = array_map('trim', $_POST);
            $activities = array_map('ucfirst', $activities);

            // data checks
            $errors = $this->validate($activities);
            $errorsLength = $this->validateLength($activities);

            if (empty($errors)) {
                // if validation is ok, insert and redirection
                $activityManager = new ActivityManager();
                $activityManager->insert($activities);
                header('Location:/adminActivity/index');
            }

            if (empty($errorsLength)) {
                // if validation is ok, insert and redirection
                $activityManager = new ActivityManager();
                $activityManager->insert($activities);
                header('Location:/adminActivity/index');
            }
        }

        return $this->twig->render('Admin/Activity/add.html.twig', [
            'errors' => $errors, 'errorsLength' => $errorsLength]);
    }

/**
 * Data checks
 */
    public function validate(array $activities): array
    {
        $errors = [];
        if (empty($activities['name'])) {
            $errors[] = "Le nom de l'activité est obligatoire.";
        }

        if (empty($activities['weekday'])) {
            $errors[] = "Vous devez indiquer le jour.";
        }

        if (empty($activities['instructor_name'])) {
            $errors[] = "Le nom de l'animateur est obligatoire";
        }

        if (empty($activities['start_time'])) {
            $errors[] = "Veuillez indiquer une heure de début pour cette activité";
        }

        if (empty($activities['end_time'])) {
            $errors[] = "Veuillez indiquer une heure de début pour cette activité";
        }

        if (filter_var($activities['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Cette URL n'est pas valide.";
        }

        if ($activities['start_time'] > $activities['end_time']) {
            $errors[] = 'L\'heure de fin de l\'activité doit être postérieure à l\'heure de début.';
        }

        return $errors;
    }

    public function validateLength(array $activities): array
    {
        $errorsLength = [];

        if (strlen($activities['name']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom de l\'activité ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor_name']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom du moniteur ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['image']) > self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'L\'url de l\' image ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['description']) < self::MAX_FIELD_LENGTH) {
            $errorsLength[] = 'La description de l\'activité ne peut pas dépasser' . self::MAX_FIELD_LENGTH .
                ' caractères';
        }

        if (strlen($activities['name']) < self::MIN_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom de l\'activité doit faire plus de' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor_name']) < self::MIN_FIELD_LENGTH) {
            $errorsLength[] = 'Le nom du moniteur doit faire plus de' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        return $errorsLength;
    }
    
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll('name');
        return $this->twig->render('Admin/Activity/index.html.twig', ['activities' => $activities]);
    }
}
