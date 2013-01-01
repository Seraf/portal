<?php

namespace Enovance\NumeterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnovanceNumeterBundle:Graphs:index.html.twig', array());
    }
}
