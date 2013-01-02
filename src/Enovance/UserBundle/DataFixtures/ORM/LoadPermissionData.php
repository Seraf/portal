<?php

namespace Enovance\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Enovance\UserBundle\Entity\Permission;

class LoadPermissionData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {

  public function getOrder() {
    return 10;
  }

  public function load(ObjectManager $manager) {
    $permission = new Permission();
    $permission->setName('Graph: create');
    $permission->setMachineName('GRAPH_CREATE');
    $permission->setWeight(1);
    $manager->persist($permission);
    $this->addReference('perm-graph-create', $permission);

    $permission = new Permission();
    $permission->setName('Graph: update');
    $permission->setMachineName('GRAPH_UPDATE');
    $permission->setWeight(2);
    $manager->persist($permission);
    $this->addReference('perm-graph-update', $permission);

    $permission = new Permission();
    $permission->setName('Graph: view');
    $permission->setMachineName('GRAPH_READ');
    $permission->setWeight(3);
    $manager->persist($permission);
    $this->addReference('perm-graph-read', $permission);

    $permission = new Permission();
    $permission->setName('Graph: delete');
    $permission->setMachineName('GRAPH_DELETE');
    $permission->setWeight(4);
    $manager->persist($permission);
    $this->addReference('perm-graph-delete', $permission);

    $manager->flush();
  }

}
