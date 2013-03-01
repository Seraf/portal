<?php

namespace Enovance\PortalBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Enovance\PortalBundle\MenuEvents;
use Enovance\PortalBundle\Event\ConfigureMenuEvent;
/**
 * Builder
 *
 * @category   MenuBuilder
 * @package    EnovancePortalBundle
 * @subpackage Menu
 * @author     Julien Syx <julien.syx@enovance.com>
 * @copyright  2013 Enovance
 * @license    http://opensource.org/licenses/MIT The MIT License
 */
class Builder extends ContainerAware
{
     /**
     * Builds the responsive navbar menu.
     *
     * @param \Knp\Menu\FactoryInterface $factory The menu factory
     * @param array                      $options The options array
     *
     * @return \Knp\Menu\ItemInterface The root item
     */
    public function MenuNavbar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $item = $menu->addChild('Dashboard', array('route' => 'enovance_portal_dashboard_index'));
        $this->container->get('event_dispatcher')->dispatch(ConfigureMenuEvent::CONFIGUREMENU, new ConfigureMenuEvent($factory, $menu));

        return $menu;
    }

    public function SessionNavbar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
    	$user = $this->container->get('security.context')->getToken()->getUser();  // Get the current logged in user
        $dropdown = $menu->addChild($user->getFirstname().' '.$user->getLastname());
        $dropdown->addChild('Profile', array('route' => 'fos_user_profile_show'));
        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
	    $dropdown->addChild('Admin', array('route' => 'enovance_portal_admin_index'));
        }
        $dropdown->addChild('Logout', array('route' => 'fos_user_security_logout'));

        return $menu;
    }

    public function AdminMenuNavbar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $this->container->get('event_dispatcher')->dispatch(ConfigureMenuEvent::CONFIGUREADMIN, new ConfigureMenuEvent($factory, $menu));

        return $menu;
    }

}
?>
