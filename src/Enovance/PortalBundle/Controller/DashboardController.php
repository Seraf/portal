<?php

namespace Enovance\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $loggedUser = $this->get('security.context')->getToken()->getUser();
        $this->get('request')->setLocale($loggedUser->getLanguage());
        return $this->render('EnovancePortalBundle:Dashboard:index.html.twig');
    }
}
