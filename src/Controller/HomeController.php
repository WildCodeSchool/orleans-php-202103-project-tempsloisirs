<?php

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $information = $homeManager->selectInfo('date');
        return $this->twig->render('Home/index.html.twig', ['information' => $information]);
    }
}
