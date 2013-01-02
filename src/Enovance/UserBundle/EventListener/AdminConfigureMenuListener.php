<?php
// src/Enovance/UserBundle/EventListener/AdminConfigureMenuListener.php

namespace Enovance\UserBundle\EventListener;

use Enovance\PortalBundle\Event\ConfigureMenuEvent;

class AdminConfigureMenuListener
{
    /**
     * @param \Enovance\UserBundle\Event\ConfigureMenuEvent $event
     */
    public function onAdminMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $team = $menu->addChild('Team management');
        $team->addChild('Users', array('route' => 'enovance_numeter_graph_index'));
        $team->addChild('Groups', array('route' => 'enovance_numeter_graph_index'));
        $team->addChild('Companies', array('route' => 'enovance_numeter_graph_index'));
    }
}
?>
