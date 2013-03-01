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
        $group1 = new Group('Admin');
        $group1->addUser($this->getReference('admin-user'));
        $group1->addUser($this->getReference('admin-user2'));
        $group1->addRole('ROLE_ADMIN');
        $group1->addPermission($manager->merge($this->getReference('perm-graph-create')));
        $group1->addPermission($manager->merge($this->getReference('perm-graph-read')));
        $group1->addPermission($manager->merge($this->getReference('perm-graph-update')));
        $group1->addPermission($manager->merge($this->getReference('perm-graph-delete')));

        $group2 = new Group('Engineer');
        $group2->addUser($this->getReference('user-user1'));
        $group2->addUser($this->getReference('user-user2'));
        $group2->addRole('ROLE_USER');
        $group2->addPermission($manager->merge($this->getReference('perm-graph-read')));

        $group3 = new Group('Dev');
        $group3->addUser($this->getReference('user-user3'));
        $group3->addUser($this->getReference('user-user2'));
        $group3->addRole('ROLE_USER');
        $group3->addPermission($manager->merge($this->getReference('perm-graph-create')));
        $group3->addPermission($manager->merge($this->getReference('perm-graph-read')));

        $manager->persist($group1);
        $manager->flush();

        $manager->persist($group2);
        $manager->flush();

        $manager->persist($group3);
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
