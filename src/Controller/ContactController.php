<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    //    private array $errors = [];
    private const MAX_LENGTH_NAME = 100;

    public function index(): string
    {
        $titles = ['M' => 'Monsieur', 'Mme' => 'Madame', 'Melle' => 'Mademoiselle'];
        $errorsEmpty = $errorsLength = $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);

            $errorsEmpty = $this->validateEmpty($data);
            $errorsLength = $this->validateLength($data);

            $errors = array_merge($errorsEmpty, $errorsLength);

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Mauvais format d\'email';
            }

            if (!in_array($data['title'], $titles)) {
                $errors[] = 'Le titre n\'est pas valable';
            }

            if (empty($errors)) {
                //send in mail
                header('Location: /Contact/thanks/' . $data['firstname'] . '/' . $data['lastname']);
            }
        }

        return $this->twig->render(
            'Contact/index.html.twig',
            [
                'errors' => $errors,
                'titles' => $titles
            ]
        );
    }

    private function validateEmpty($data)
    {
        $errorsEmpty = [];

        if (empty($data['firstname'])) {
            $errorsEmpty[] = 'Le prénom est obligatoire';
        }

        if (empty($data['lastname'])) {
            $errorsEmpty[] = 'Le nom est obligatoire';
        }

        if (empty($data['phone'])) {
            $errorsEmpty[] = 'Le téléphone est obligatoire';
        }

        if (empty($data['email'])) {
            $errorsEmpty[] = 'L\'email est obligatoire';
        }

        if (empty($data['message'])) {
            $errorsEmpty[] = 'Un message est obligatoire';
        }

        return $errorsEmpty;
    }

    private function validateLength($data)
    {
        $errorsLength = [];

        if (strlen($data['firstname']) > self::MAX_LENGTH_NAME) {
            $errorsLength[] = 'Le prénom ne doit pas dépassé ' . self::MAX_LENGTH_NAME . ' caractères';
        }

        if (strlen($data['lastname']) > self::MAX_LENGTH_NAME) {
            $errorsLength[] = 'Le nom ne doit pas dépassé ' . self::MAX_LENGTH_NAME . ' caractères';
        }

        if (strlen($data['phone']) > 10) {
            $errorsLength[] = 'Le téléphone ne doit pas dépassé 10 chiffres';
        }

        return $errorsLength;
    }

    public function thanks(string $firstname, string $lastname): string
    {
        return $this->twig->render('Contact/thanks.html.twig', ['firstname' => $firstname, 'lastname' => $lastname]);
    }
}
