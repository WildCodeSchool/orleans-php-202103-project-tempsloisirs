<?php

namespace App\Controller;

use App\Model\AdminActivityManager;

class AdminActivityController extends AbstractController
{
    public const MAX_FIELD_LENGTH = 255;
    public const MIN_FIELD_LENGTH = 1;

    /**
     * Add a new item
     */
    public function add(): string
    {
        $errors = $activity = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = $this->clean($_POST);
            // data checks
            $errors = $this->validate($activities);

            if (empty($errors)) {
                // if validation is ok, insert and redirection
                $adminActivityManager = new AdminActivityManager();
                $adminActivityManager->insert($activities);
                header('Location:/AdminActivity/index');
            }
        }

        return $this->twig->render('Admin/Activity/add.html.twig', ['errors' => $errors,
            'activity' => $activity]);
    }

/**
 * Clean $_POST data
 */
    public function clean(): array
    {
        $errors = $activity = [];

        $activities = array_map('trim', $_POST);
        return $activities = array_map('ucfirst', $activities);
    }

/**
 * Data checks
 */
    public function validate(array $activities): array
    {
        $errors = [];
        // Empty fields
        if (empty($activities['name'])) {
            $errors[] = "Le nom de l'activité est obligatoire.";
        }
        if (empty($activities['weekday'])) {
            $errors[] = "Vous devez indiquer le jour.";
        }
        if (empty($activities['instructor'])) {
            $errors[] = "Le nom de l'animateur est obligatoire";
        }
        if (empty($activities['startTime'] || $activities['endTime'])) {
            $errors[] = "Veuillez indiquer une heure de début et une heure de fin pour cette activité";
        }

        // URL format
        if (filter_var($activities['image'], FILTER_VALIDATE_URL)) {
            $errors[] = "Cette URL n'est pas valide.";
        }

        // Max field length
        if (strlen($activities['name']) > self::MAX_FIELD_LENGTH) {
            $errors[] = 'Le nom de l\'activité ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor']) > self::MAX_FIELD_LENGTH) {
            $errors[] = 'Le nom du moniteur ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['image']) > self::MAX_FIELD_LENGTH) {
            $errors[] = 'L\'url de l\' image ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['description']) < self::MAX_FIELD_LENGTH) {
            $errors[] = 'La description de l\'activité ne peut pas dépasser' . self::MAX_FIELD_LENGTH . ' caractères';
        }

        // Min field length
        if (strlen($activities['name']) < self::MIN_FIELD_LENGTH) {
            $errors[] = 'Le nom de l\'activité doit faire plus de' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        if (strlen($activities['instructor']) < self::MIN_FIELD_LENGTH) {
            $errors[] = 'Le nom du moniteur doit faire plus de' . self::MIN_FIELD_LENGTH . ' caractères';
        }

        //Time checks

        return $errors;
    }
}
