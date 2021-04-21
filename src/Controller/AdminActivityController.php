<?php

namespace App\Controller;

use App\Model\ActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll('name');
        return $this->twig->render('Admin/Activity/index.html.twig', ['activities' => $activities]);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityManager = new ActivityManager();
            $activityManager->delete($id);
            header('Location:/AdminActivity/index');

        }
    }
}
