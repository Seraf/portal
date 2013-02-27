<?php
namespace Enovance\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('julien.syx');
        $userAdmin->setPlainPassword('enovance');
        $userAdmin->setEmail('julien.syx@enovance.com');
        $userAdmin->setFirstname('Julien');
        $userAdmin->setLastname('Syx');
        $userAdmin->setEnabled(True);
        $manager->persist($userAdmin);
        $manager->flush();

        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setPlainPassword('enovance');
        $user1->setEmail('user1@enovance.com');
        $user1->setFirstname('User');
        $user1->setLastname('First');
        $user1->setEnabled(True);
        $manager->persist($user1);
        $manager->flush();
        $user2 = new User();
        $user2->setUsername('user2');
        $user2->setPlainPassword('enovance');
        $user2->setEmail('user2@enovance.com');
        $user2->setFirstname('User');
        $user2->setLastname('Second');
        $user2->setEnabled(True);
        $manager->persist($user2);
        $manager->flush();
        $user3 = new User();
        $user3->setUsername('user3');
        $user3->setPlainPassword('enovance');
        $user3->setEmail('user3@enovance.com');
        $user3->setFirstname('User');
        $user3->setLastname('Third');
        $user3->setEnabled(True);
        $manager->persist($user3);
        $manager->flush();

        $this->addReference('admin-user', $userAdmin);
        $this->addReference('user-user1', $user1);
        $this->addReference('user-user2', $user2);
        $this->addReference('user-user3', $user3);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}
?>
