<?php
namespace Enovance\NumeterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\NumeterBundle\Entity\Storage;

class LoadStorageData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $storage = new Storage();
        $storage->setName('numeter');
        $storage->setAddr('94.143.115.170');
        $storage->setPort('8080');

        $manager->persist($storage);
        $manager->flush();

        $this->addReference('storage', $storage);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
?>
