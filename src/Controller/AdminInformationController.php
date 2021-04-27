<?php

namespace App\Controller;

use App\Model\InformationManager;

class AdminInformationController extends AbstractController
{
    private const MAX_CONTENT_LENGTH = 255;
    private const MAX_DATE_LENGTH = 12;

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
        $informations = $informationManager->selectOneById($id);

        $errorsEmpty = $errorsLength = $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $informations = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($informations);
            $errorsLength = $this->validateLength($informations);

            $errors = array_merge($errorsEmpty, $errorsLength);

            if (empty($errors)) {
                // update en database
                $informations['id'] = $id;
                $informationManager->update($informations);

                // redirection
                header('Location: /adminInformation/edit/' . $id);
            }
        }

        return $this->twig->render('Admin/Information/edit.html.twig', [
            'errors' => $errors,
            'informations' => $informations,
        ]);
    }
}
