<?php

namespace Enovance\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function usersAction()
    {
        return $this->render('EnovanceUserBundle:Admin:users.html.twig', array());
    }

    public function groupsAction()
    {
        return $this->render('EnovanceUserBundle:Admin:groups.html.twig', array());
    }

    public function companiesAction()
    {
        return $this->render('EnovanceUserBundle:Admin:companies.html.twig', array());
    }
}


