<?php

namespace App\Controller;

class AboutController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('About/index.html.twig');
    }
}
