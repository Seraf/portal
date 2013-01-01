<?php
// src/Enovance/InfrastructureBundle/DataFixtures/ORM/LoadHostData.php
namespace Enovance\InfrastructureBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\InfrastructureBundle\Entity\Host;
use Enovance\NumeterBundle\Entity\Storage;



class LoadHostData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $storage = $this->getReference('storage');

        $host = new Host();
        $host->setName('eno-eh7-b1.mut-6.hosting.enovance.com');
        $host->setAddr('eno-eh7-b1.mut-6.hosting.enovance.com');
        $host->setNumeterUID('1348232991-7e518eb46168a2f90e969304385e5d3c');
        $host->setStorage($storage);

        $this->addReference('host-1', $host);
        $manager->persist($host);
        $manager->flush();

        $host = new Host();
        $host->setName('backup-eq2');
        $host->setAddr('backup-eq2-2.enovance.com');
        $host->setNumeterUID('1348230493-3ea8bb35ed8d4a6d4932ccff62c4b994');
        $host->setStorage($storage);

        $this->addReference('host-2', $host);
        $manager->persist($host);
        $manager->flush();

        $host = new Host();
        $host->setName('compute4');
        $host->setAddr('compute4.enocloud.com');
        $host->setNumeterUID('1349274010-d6981936c54b627c562e477516ecd554');
        $host->setStorage($storage);

        $this->addReference('host-3', $host);
        $manager->persist($host);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}
?>
