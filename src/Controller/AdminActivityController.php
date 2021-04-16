<?php

namespace App\Controller;

use App\Model\AdminActivityManager;

class AdminActivityController extends AbstractController
{
    public function index(): string
    {
        $adminActivityManager = new AdminActivityManager();
        $activities = $adminActivityManager->selectAll('name');
        return $this->twig->render('Admin/AdminActivity/index.html.twig', ['activities' => $activities]);
    }

    /* TODO
    public function home(): string
    {
        return $this->twig->render('Admin/home.html.twig');
    }

    public function delete(): string
    {
        $adminManager = new AdminManager();
        $activities = $adminManager->selectAll('firstname');
        return $this->twig->render('Admin/activities.html.twig', ['activities'=> $activities]);
    }

    public function addActivity(): string
    {
        $adminManager = new AdminManager();
        $activities = $adminManager->selectAll('firstname');
        return $this->twig->render('Admin/activities.html.twig', ['activities'=> $activities]);
    }

    public function editActivity(): string
    {
        $adminManager = new AdminManager();
        $activities = $adminManager->selectAll('firstname');
        return $this->twig->render('Admin/activities.html.twig', ['activities'=> $activities]);
    }*/
}
