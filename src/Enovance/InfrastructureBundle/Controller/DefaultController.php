<?php

namespace Enovance\InfrastructureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EnovanceInfrastructureBundle:Default:index.html.twig', array('name' => $name));
    }
}
