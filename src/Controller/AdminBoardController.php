<?php

namespace App\Controller;

use App\Model\AdminBoardManager;

class AdminBoardController extends AbstractController
{
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
        $errorsEmpty = $errorsLength = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $boardMember = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($boardMember);
            $errorsLength = $this->validateLength($boardMember);

            if (empty($errorsEmpty) && empty($errorsLength)) {
                $adminBoardManager = new AdminBoardManager();
                $adminBoardManager->insert($boardMember);
                header('Location:/adminBoard/index');
            }
        }

        return $this->twig->render('Admin/Board/add.html.twig', [
            'errorsEmpty' => $errorsEmpty,
            'errorsLength' => $errorsLength]);
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

        $firstnameLength = 80;
        if (strlen($boardMember['firstname']) > $firstnameLength) {
            $errorsLength[] = 'Le prénom doit faire moins de ' . $firstnameLength . ' caractères';
        }

        $lastnameLength = 80;
        if (strlen($boardMember['surname']) > $lastnameLength) {
            $errorsLength[] = 'Le nom doit faire moins de ' . $lastnameLength . ' caractères';
        }

        $roleLength = 80;
        if (strlen($boardMember['role']) > $roleLength) {
            $errorsLength[] = 'La fonction doit faire moins de ' . $roleLength . ' caractères';
        }

        $imageLength = 255;
        if (strlen($boardMember['image']) > $imageLength) {
            $errorsLength[] = 'Le lien de l\'image doit faire moins de ' . $imageLength . ' caractères';
        }

        return $errorsLength;
    }
}
