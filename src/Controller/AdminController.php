<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function activities(): string
    {
        $adminManager = new AdminManager();
        $activities = $adminManager->selectAll('name');
        return $this->twig->render('Admin/activities.html.twig', ['activities' => $activities]);
    }

    public function home(): string
    {
        return $this->twig->render('Admin/home.html.twig');
    }



    /* TODO
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
