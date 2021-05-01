<?php

namespace App\Controller;

//use App\Model\ActivityManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $information = $homeManager->selectAll('date');
        return $this->twig->render('Home/index.html.twig', ['information' => $information]);
    }
}
