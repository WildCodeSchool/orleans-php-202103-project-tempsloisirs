<?php

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $information = $homeManager->selectInfo('date');
        $events = $homeManager->selectEvent('date');
        $activities = $homeManager->selectActivity('date');
        $photos = $homeManager->selectPhoto('date');
        return $this->twig->render('Home/index.html.twig', 
        ['information' => $information,
        'events' => $events,
        'activities' => $activities,
        'photos' => $photos
        ]);
    }
}
