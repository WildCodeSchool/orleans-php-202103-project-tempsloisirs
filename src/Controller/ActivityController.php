<?php

namespace App\Controller;

use App\Model\ActivityManager;

class ActivityController extends AbstractController
{
    public const MAX_FIELD_LENGTH = 255;
    public const MIN_FIELD_LENGTH = 2;

    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities  = $activityManager->selectAll('name');
        $photos = $activityManager->selectPhotos('id');
        return $this->twig->render('Home/activity.html.twig', ['activities' => $activities, 'photos' => $photos]);
    }
}
