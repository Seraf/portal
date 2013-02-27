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

        $company1 = new Company();
        $company1->setName('Company1');
        $company1->addUser($this->getReference('user-user1'));
        $company1->addHost($host1);
        $manager->persist($company1);
        $manager->flush();

        $company2 = new Company();
        $company2->setName('Company2');
        $company2->addUser($this->getReference('user-user2'));
        $company2->addHost($host2);
        $manager->persist($company2);
        $manager->flush();

        $company3 = new Company();
        $company3->setName('Company3');
        $company3->addUser($this->getReference('user-user3'));
        $company3->addHost($host3);
        $manager->persist($company1);
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
