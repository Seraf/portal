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

        $item = $menu->addChild('Dashboard', array('uri' => '/dashboard'));
        $this->container->get('event_dispatcher')->dispatch(ConfigureMenuEvent::CONFIGURE, new ConfigureMenuEvent($factory, $menu));

        return $menu;
    }

    public function SessionNavbar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $dropdown = $menu->addChild('Dropdown');
        $dropdown->addChild('Action', array('uri' => '#'));
        $dropdown->addChild('Another action', array('uri' => '#'));
        $dropdown->addChild('Something else here', array('uri' => '#'));

        return $menu;
    }

}
?>
