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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $boardMember = array_map('trim', $_POST);

            $errors = $this->validate($boardMember);

            if (empty($errors)) {
                $adminBoardManager = new AdminBoardManager();
                $adminBoardManager->insert($boardMember);
                header('Location:/adminBoard/index');
            }
        }

        return $this->twig->render('Admin/Board/add.html.twig', ['errors' => $errors]);
    }

    private function validate($boardMember)
    {
        if (empty($boardMember['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if (empty($boardMember['surname'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (empty($boardMember['role'])) {
            $errors[] = 'Une fonction est obligatoire';
        }

        if (empty($boardMember['image'])) {
            $errors[] = 'Une image est obligatoire';
        }

        $firstnameLength = 80;
        if (strlen($boardMember['firstname']) > $firstnameLength) {
            $errors[] = 'Le prénom doit faire moins de ' . $firstnameLength . ' caractères';
        }

        $lastnameLength = 80;
        if (strlen($boardMember['surname']) > $lastnameLength) {
            $errors[] = 'Le nom doit faire moins de ' . $lastnameLength . ' caractères';
        }

        $roleLength = 80;
        if (strlen($boardMember['role']) > $roleLength) {
            $errors[] = 'La fonction doit faire moins de ' . $roleLength . ' caractères';
        }

        $imageLength = 255;
        if (strlen($boardMember['image']) > $imageLength) {
            $errors[] = 'Le lien de l\'image doit faire moins de ' . $imageLength . ' caractères';
        }

        return $errors ?? [];
    }
}
