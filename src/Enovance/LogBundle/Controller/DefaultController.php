<?php

namespace Enovance\LogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EnovanceLogBundle:Default:index.html.twig', array('name' => $name));
    }
}
