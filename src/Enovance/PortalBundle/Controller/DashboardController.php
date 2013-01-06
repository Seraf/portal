<?php

namespace Enovance\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $loggedUser = $this->get('security.context')->getToken()->getUser();
        return $this->render('EnovancePortalBundle:Dashboard:index.html.twig');
    }
}
