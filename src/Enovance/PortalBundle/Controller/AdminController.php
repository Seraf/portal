<?php

namespace Enovance\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnovancePortalBundle:Admin:index.html.twig');
    }
}
