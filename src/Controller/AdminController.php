<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class AdminController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function home()
    {
        return $this->twig->render('Admin/home.html.twig');
    }

    public function activities()
    {
        return $this->twig->render('Admin/activities.html.twig');
    }
    
    public function events()
    {
        return $this->twig->render('Admin/events.html.twig');
    }

    public function board()
    {
        return $this->twig->render('Admin/board.html.twig');
    }

    public function informations()
    {
        return $this->twig->render('Admin/informations.html.twig');
    }
}
