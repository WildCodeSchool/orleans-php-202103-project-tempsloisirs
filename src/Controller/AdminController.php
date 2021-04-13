<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function board()
    {
        return $this->twig->render('Admin/board.html.twig');
    }
}
