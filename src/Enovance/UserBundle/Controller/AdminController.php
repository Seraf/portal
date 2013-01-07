<?php

namespace Enovance\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function usersAction()
    {
        $query = $this->getDoctrine()->getRepository('EnovanceUserBundle:User')->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.lastname')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate($query, $this->get('request')->query->get('page', 1), 10);

        return $this->render('EnovanceUserBundle:Admin:users.html.twig', array('users' => $users));
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


