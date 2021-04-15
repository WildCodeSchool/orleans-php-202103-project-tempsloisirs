<?php

namespace App\Controller;

class EventsAdminController extends AbstractController
{




    public function index(): string
    {
        return $this->twig->render('Admin/_eventsAdmin.html.twig');
    }

    public function addEventIndex(): string
    {
        return $this->twig->render('Admin/_addeventsAdmin.html.twig');
    }
}
