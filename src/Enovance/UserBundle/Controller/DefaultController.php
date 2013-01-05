<?php

namespace Enovance\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EnovanceUserBundle:Default:index.html.twig', array('name' => $name));
    }

    public function changeLanguageAction($_locale)
    {
        $this->get('request')->setLocale($_locale);
        $referer = $this->get('request')->headers->get('referer');
        return $this->redirect($referer);
    }
}
