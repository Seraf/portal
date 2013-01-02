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

        $numeter = $menu->addChild('Numeter');
        $numeter->addChild('Graphs', array('route' => 'enovance_numeter_graph_index'));
    }
}
?>
