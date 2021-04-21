<?php

namespace App\Controller;

use App\Model\AdminBoardManager;

class AdminBoardController extends AbstractController
{
    const FIRSTNAMELENGTH = 80;
    const LASTNAMELENGTH = 80;
    const ROLELENGTH = 80;
    const IMAGELENGTH = 255;

    /**
     * Show informations for a specific item
     **/
    public function index(): string
    {
        $adminManager = new AdminBoardManager();
        $boardMembers = $adminManager->selectAll('firstname');

        return $this->twig->render('Admin/Board/index.html.twig', ['boardMembers' => $boardMembers]);
    }

    /**
     * Add an item
     */
    public function add()
    {
        $errorsEmpty = $errorsLength = $errorsFilter = $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $boardMember = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($boardMember);
            $errorsLength = $this->validateLength($boardMember);
            $errorsFilter = $this->validateFilter($boardMember);

            $errors = array_merge($errorsEmpty, $errorsFilter, $errorsLength);

            if (empty($errors)) {
                $adminBoardManager = new AdminBoardManager();
                $adminBoardManager->insert($boardMember);
                header('Location:/adminBoard/index');
            }
        }

        return $this->twig->render('Admin/Board/add.html.twig', [
            'errors' => $errors]);
    }

    private function validateEmpty($boardMember)
    {
        $errorsEmpty = [];

        if (empty($boardMember['firstname'])) {
            $errorsEmpty[] = 'Le prénom est obligatoire';
        }

        if (empty($boardMember['surname'])) {
            $errorsEmpty[] = 'Le nom est obligatoire';
        }

        if (empty($boardMember['role'])) {
            $errorsEmpty[] = 'Une fonction est obligatoire';
        }

        if (empty($boardMember['image'])) {
            $errorsEmpty[] = 'Une image est obligatoire';
        }

        return $errorsEmpty;
    }

    public function validateLength($boardMember)
    {
        $errorsLength = [];

        if (strlen($boardMember['firstname']) > self::FIRSTNAMELENGTH) {
            $errorsLength[] = 'Le prénom doit faire moins de ' . self::FIRSTNAMELENGTH . ' caractères';
        }

        if (strlen($boardMember['surname']) > self::LASTNAMELENGTH) {
            $errorsLength[] = 'Le nom doit faire moins de ' . self::LASTNAMELENGTH . ' caractères';
        }

        if (strlen($boardMember['role']) > self::ROLELENGTH) {
            $errorsLength[] = 'La fonction doit faire moins de ' . self::ROLELENGTH . ' caractères';
        }

        $imageLength = 255;
        if (strlen($boardMember['image']) > self::IMAGELENGTH) {
            $errorsLength[] = 'Le lien de l\'image doit faire moins de ' . self::IMAGELENGTH . ' caractères';
        }

        return $errorsLength;
    }

    public function validateFilter($boardMember)
    {
        $errorsFilter = [];

        if (!filter_var($boardMember['image'], FILTER_VALIDATE_URL)) {
            $errorsFilter[] = 'L\'image doit être un URL';
        }

        return $errorsFilter;
    }
}
