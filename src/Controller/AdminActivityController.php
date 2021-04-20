<?php

namespace App\Controller;

use App\Model\AdminActivityManager;

class AdminActivityController extends AbstractController
{
    /**
     * Add a new item
     */
    public function add(): string
    {
        $errors = [];
        $activity = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = array_map('trim', $_POST);
            $activities = array_map('ucfirst', $activities);

            //Not empty
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

            /*Time check: end date must be superior to start date
            if ($activities['startTime'] > $activities['endTime']) {
                $errors[] = "Cette URL n'est pas valide.";
            }*/

            if (empty($errors)) {
                // if validation is ok, insert and redirection
                $adminActivityManager = new AdminActivityManager();
                $id = $adminActivityManager->insert($activities);
                header('Location:/Item/show' . $id);

            }

        }

        return $this->twig->render('Admin/Activity/add.html.twig', ['errors' => $errors,
            'activity' => $activity]);

        // TODO validations (length, format...)

    }

}
