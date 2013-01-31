<?php

namespace Enovance\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EnovancePortalBundle:Default:index.html.twig', array('name' => $name));
    }
}
