<?php

namespace Enovance\LogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Enovance\UserBundle\Entity\Permission;

class LoadLogPermissionData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

  public function getOrder() {
    return 10;
  }

  public function load(ObjectManager $manager) {
    $permission = new Permission();
    $permission->setName('Log: create');
    $permission->setMachineName('LOG_CREATE');
    $permission->setWeight(1);
    $manager->persist($permission);
    $this->addReference('perm-log-create', $permission);

    $permission = new Permission();
    $permission->setName('Log: update');
    $permission->setMachineName('LOG_UPDATE');
    $permission->setWeight(2);
    $manager->persist($permission);
    $this->addReference('perm-log-update', $permission);

    $permission = new Permission();
    $permission->setName('Log: view');
    $permission->setMachineName('LOG_READ');
    $permission->setWeight(3);
    $manager->persist($permission);
    $this->addReference('perm-log-read', $permission);

    $permission = new Permission();
    $permission->setName('Log: delete');
    $permission->setMachineName('LOG_DELETE');
    $permission->setWeight(4);
    $manager->persist($permission);
    $this->addReference('perm-log-delete', $permission);

    $manager->flush();
  }

}
