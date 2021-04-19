<?php

namespace App\Controller;

use App\Model\AdminActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $adminActivityManager = new AdminActivityManager();
        $activities = $adminActivityManager->selectAll('name');
        return $this->twig->render('Admin/Activity/index.html.twig', ['activities' => $activities]);
    }
}
