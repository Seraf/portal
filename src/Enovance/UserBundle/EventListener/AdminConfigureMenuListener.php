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
        $team->addChild('admin.Users', array('route' => 'enovance_admin_users'))->setExtra('translation_domain', 'UserBundle');
        $team->addChild('admin.Groups', array('route' => 'enovance_admin_groups'))->setExtra('translation_domain', 'UserBundle');
        $team->addChild('admin.Companies', array('route' => 'enovance_admin_companies'))->setExtra('translation_domain', 'UserBundle');
    }
}
?>
