<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\EventManager;
use App\Model\InformationManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $eventManager = new EventManager();
        $informationManager = new InformationManager();
        $events = $eventManager->selectAll();
        $activities = $activityManager->selectAll();
        $informations = $informationManager->selectAll();
        return $this->twig->render('Home/index.html.twig', ['events' => $events,
        'activities' => $activities,
        'informations' => $informations,]);
    }

    public function informations(): string
    {
        $informationManager = new InformationManager();
        $informations = $informationManager->selectAll();
        return $this->twig->render('Home/informations.html.twig', ['informations' => $informations,]);
    }
}
