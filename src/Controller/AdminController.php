<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function home(): string
    {
        return $this->twig->render('Admin/home.html.twig');
    }
}
