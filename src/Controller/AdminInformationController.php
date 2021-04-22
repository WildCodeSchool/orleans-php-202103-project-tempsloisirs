<?php

namespace App\Controller;

use App\Model\InformationManager;

class AdminInformationController extends AbstractController
{
    /*
     Show informations for a specific item
     */
    public const MAX_FIELD_LENGTH = 255;
    public function index(): string
    {
        $informationManager = new InformationManager();
        $informations = $informationManager->selectAll('informations');

        return $this->twig->render('Admin/Information/index.html.twig', ['informations' => $informations]);
    }
    /**
     * Add a new item
     */

    public function add(): string
    {
        $errors = $informations = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            // clean $_POST data
            $informations = array_map('trim', $_POST);

            if (empty($informations['date'])) {
                $errors[] = 'le champs date est obligatoire';
            }

            if (empty($informations['content'])) {
                $errors[] = 'le champs information est obligatoire';
            }
            if (empty($informations['type'])) {
                $errors[] = 'le champs type est obligatoire';
            }

            if (strlen($informations['type']) > 20) {
                $errors[] = 'le champs type doit doit faire moins de 20 caractères';
            }

            if (strlen($informations['content']) > self::MAX_FIELD_LENGTH) {
                $errors[] = 'le champs information doit faire moins de ' . self::MAX_FIELD_LENGTH . 'caractères';
            }

            if (empty($errors)) {
                //insert en database
                $informationManager = new InformationManager();
                $informationManager->insert($informations);

                //redirection
                header('Location: /dminInformation/index');
            }
        }

        return $this->twig->render('Admin/Information/add.html.twig', [
            'errors' => $errors,
            'informations' => $informations,
        ]);
    }
}
