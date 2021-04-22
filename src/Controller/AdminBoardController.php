<?php

namespace App\Controller;

use App\Model\AdminBoardManager;

class AdminBoardController extends AbstractController
{
    private const FIRSTNAME_LENGTH = 80;
    private const LASTNAME_LENGTH = 80;
    private const ROLE_LENGTH = 80;
    private const IMAGE_LENGTH = 255;

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
     * Delete informations for a specific item
     **/
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminBoardManager = new AdminBoardManager();
            $adminBoardManager->delete($id);
            header('Location:/adminBoard/index');
        }
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
            'errors' => $errors
        ]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $adminManager = new AdminBoardManager();
        $boardMember = $adminManager->selectOneById($id);

        $errorsEmpty = $errorsLength = $errorsFilter = $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $boardMember = array_map('trim', $_POST);
            $boardMember['id'] = $id;

            $errorsEmpty = $this->validateEmpty($boardMember);
            $errorsLength = $this->validateLength($boardMember);
            $errorsFilter = $this->validateFilter($boardMember);

            $errors = array_merge($errorsEmpty, $errorsFilter, $errorsLength);

            if (empty($errors)) {
                $adminManager->update($boardMember);
                header('Location:/adminBoard/index');
            }
        }

        return $this->twig->render('Admin/Board/edit.html.twig', [
            'boardMember' => $boardMember,
            'errors' => $errors
        ]);
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

        if (strlen($boardMember['firstname']) > self::FIRSTNAME_LENGTH) {
            $errorsLength[] = 'Le prénom doit faire moins de ' . self::FIRSTNAME_LENGTH . ' caractères';
        }

        if (strlen($boardMember['surname']) > self::LASTNAME_LENGTH) {
            $errorsLength[] = 'Le nom doit faire moins de ' . self::LASTNAME_LENGTH . ' caractères';
        }

        if (strlen($boardMember['role']) > self::ROLE_LENGTH) {
            $errorsLength[] = 'La fonction doit faire moins de ' . self::ROLE_LENGTH . ' caractères';
        }

        if (strlen($boardMember['image']) > self::IMAGE_LENGTH) {
            $errorsLength[] = 'Le lien de l\'image doit faire moins de ' . self::IMAGE_LENGTH . ' caractères';
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
