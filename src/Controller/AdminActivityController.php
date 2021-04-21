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

    public function edit(int $id): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $activityManager->update($activities);
            header('Location: /AdminActivity/show/' . $id);
        }

        return $this->twig->render('Admin/Activity/edit.html.twig', [
            'activities' => $activities,
        ]);
    }
}
