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

        $team = $menu->addChild('Team management', array('attributes' => array('class' => 'submenu')));
        $team->addChild('Users', array('route' => 'enovance_admin_users'));
        $team->addChild('Groups', array('route' => 'enovance_admin_groups'));
        $team->addChild('Companies', array('route' => 'enovance_admin_companies'));
    }
}
?>
