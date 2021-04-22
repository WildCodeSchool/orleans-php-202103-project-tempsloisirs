<?php

namespace App\Controller;

use App\Model\AdminActivityManager;

class AdminActivityController extends AbstractController
{
    /**
     * Add a new item
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $activities = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $adminActivityManager = new AdminActivityManager();
            $id = $adminActivityManager->insert($activities);
            header('Location:/item/show/' . $id);
        }

        return $this->twig->render('Admin/Activity/add.html.twig');
    }

    public function index(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll('name');
        return $this->twig->render('Admin/Activity/index.html.twig', ['activities' => $activities]);
    }
}
