<?php
// src/Enovance/UserBundle/DataFixtures/ORM/LoadCompanyData.php

namespace Enovance\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Enovance\UserBundle\Entity\Company;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $company = new Company();
        $company->setName('Enovance');
        $company->addUser($this->getReference('admin-user'));

        $manager->persist($company);
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
