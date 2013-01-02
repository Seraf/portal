<?php
// src/Enovance/UserBundle/DataFixtures/ORM/LoadCompanyData.php

namespace Enovance\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\UserBundle\Entity\Company;

class LoadCompanyData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $host1 = $this->getReference('host-1');
        $host2 = $this->getReference('host-2');
        $host3 = $this->getReference('host-3');


        $company = new Company();
        $company->setName('Enovance');
        $company->addUser($this->getReference('admin-user'));
        $company->addHost($host1);
        $manager->persist($company);
        $manager->flush();
        $company->addHost($host2);
        $manager->persist($company);
        $manager->flush();
        $company->addHost($host3);
        $manager->persist($company);
        $manager->flush();

        $company2 = new Company(1);
        $hosts = $company2->getHosts();
        foreach($hosts as $key=>$object)
            echo $object->getName();
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
