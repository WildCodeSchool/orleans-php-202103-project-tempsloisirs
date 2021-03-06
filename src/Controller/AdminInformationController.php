<?php

namespace App\Controller;

use App\Model\InformationManager;

class AdminInformationController extends AbstractController
{
    private const MAX_CONTENT_LENGTH = 255;
    private const MAX_DATE_LENGTH = 12;
    public const LAST_INFORMATIONS = [
        'alert' => 'Alerte ❗',
        'warning' => 'Avertissement ⚠️',
        'info' => 'Information ℹ️'
    ];

    /**
     * Show informations for a specific item
     **/
    public function index(): string
    {
        $informationManager = new InformationManager();
        $informations = $informationManager->selectAll('date');

        return $this->twig->render('Admin/Information/index.html.twig', ['informations' => $informations]);
    }

    /**
     * Delete informations for a specific item
     **/
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $informationManager = new InformationManager();
            $informationManager->delete($id);
            header('Location:/adminInformation/index');
        }
    }

    /**
     * Add a new item
     */
    public function add(): string
    {
        $errorsEmpty = $errorsLength = $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $informations = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($informations);
            $errorsLength = $this->validateLength($informations);

            $errors = array_merge($errorsEmpty, $errorsLength);

            if (empty($errors)) {
                $informationManager = new InformationManager();
                $informationManager->insert($informations);
                header('Location:/adminInformation/index');
            }
        }

        return $this->twig->render('Admin/Information/add.html.twig', [
            'errors' => $errors,
        ]);
    }

    private function validateEmpty($informations)
    {
        $errorsEmpty = [];

        if (empty($informations['type'])) {
            $errorsEmpty[] = 'Un type est obligatoire';
        }

        if (empty($informations['date'])) {
            $errorsEmpty[] = 'Une date est obligatoire';
        }

        if (empty($informations['content'])) {
            $errorsEmpty[] = 'Une description est obligatoire';
        }

        return $errorsEmpty;
    }

    public function validateLength($informations)
    {
        $errorsLength = [];

        if (strlen($informations['date']) > self::MAX_DATE_LENGTH) {
            $errorsLength[] = 'La date doit faire moins de ' . self::MAX_DATE_LENGTH . ' caractères';
        }

        if (strlen($informations['content']) > self::MAX_CONTENT_LENGTH) {
            $errorsLength[] = 'La description doit faire moins de ' . self::MAX_CONTENT_LENGTH . ' caractères';
        }

        return $errorsLength;
    }

    public function edit(int $id): string
    {
        $informationManager = new informationManager();
        $information = $informationManager->selectOneById($id);

        $errorsEmpty = $errorsLength = $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $information = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($information);
            $errorsLength = $this->validateLength($information);

            $errors = array_merge($errorsEmpty, $errorsLength);

            if (empty($errors)) {
                // update en database
                $information['id'] = $id;
                $informationManager->update($information);

                // redirection
                header('Location: /adminInformation/index/');
            }
        }

        return $this->twig->render('Admin/Information/edit.html.twig', [
            'errors' => $errors,
            'information' => $information,
        ]);
    }
}
