<?php

namespace Enovance\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnovancePortalBundle:Dashboard:index.html.twig');
    }
}
