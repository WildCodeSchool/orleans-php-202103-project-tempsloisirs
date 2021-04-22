<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function home(): string
    {
        return $this->twig->render('Admin/home.html.twig');
    }
}
