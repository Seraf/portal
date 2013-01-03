<?php

namespace Enovance\NumeterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function graphsAction()
    {
        return $this->render('EnovanceNumeterBundle:Admin:graphs.html.twig', array());
    }
}


