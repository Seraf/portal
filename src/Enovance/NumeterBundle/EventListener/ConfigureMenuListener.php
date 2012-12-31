<?php
// src/Enovance/NumeterBundle/EventListener/ConfigureMenuListener.php

namespace Enovance\NumeterBundle\EventListener;

use Enovance\PortalBundle\Event\ConfigureMenuEvent;

class ConfigureMenuListener
{
    /**
     * @param \Enovance\NumeterBundle\Event\ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('Graph', array('route' => 'enovance_numeter_graph_index'));
    }
}
?>
