<?php
// src/Enovance/NumeterBundle/EventListener/AdminConfigureMenuListener.php

namespace Enovance\NumeterBundle\EventListener;

use Enovance\PortalBundle\Event\ConfigureMenuEvent;

class AdminConfigureMenuListener
{
    /**
     * @param \Enovance\UserBundle\Event\ConfigureMenuEvent $event
     */
    public function onAdminMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $numeter = $menu->addChild('Numeter', array('attributes' => array('class' => 'submenu')));
        $numeter->addChild('Graphs', array('route' => 'enovance_admin_graphs'));
    }
}
?>
