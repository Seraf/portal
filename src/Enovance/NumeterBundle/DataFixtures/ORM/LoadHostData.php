<?php
// src/Enovance/NumeterBundle/DataFixtures/ORM/LoadHostData.php
namespace Enovance\NumeterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\NumeterBundle\Entity\Host;

class LoadHostData implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $host = new Host();
        $host->setName('eno-eh7-b1.mut-6.hosting.enovance.com');
        $host->setAddr('eno-eh7-b1.mut-6.hosting.enovance.com');
        $host->setHostID('1348232991-7e518eb46168a2f90e969304385e5d3c');
        $host->setStorageID('0');
        $manager->persist($host);
        $manager->flush();

        $host = new Host();
        $host->setName('backup-eq2');
        $host->setAddr('backup-eq2-2.enovance.com');
        $host->setHostID('1348230493-3ea8bb35ed8d4a6d4932ccff62c4b994');
        $host->setStorageID('0');
        $manager->persist($host);
        $manager->flush();

        $host = new Host();
        $host->setName('compute4');
        $host->setAddr('compute4.enocloud.com');
        $host->setHostID('1349274010-d6981936c54b627c562e477516ecd554');
        $host->setStorageID('0');
        $manager->persist($host);
        $manager->flush();
    }
}
?>
