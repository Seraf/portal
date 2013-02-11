<?php
namespace Enovance\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\UserBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $group = new Group('Admin');
        $group->addUser($this->getReference('admin-user'));
        $group->addRole('ROLE_ADMIN');
        $group->addPermission($manager->merge($this->getReference('perm-graph-create')));
        $group->addPermission($manager->merge($this->getReference('perm-graph-read')));
        $group->addPermission($manager->merge($this->getReference('perm-graph-update')));
        $group->addPermission($manager->merge($this->getReference('perm-graph-delete')));

        $manager->persist($group);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 30; // the order in which fixtures will be loaded
    }
}
?>
