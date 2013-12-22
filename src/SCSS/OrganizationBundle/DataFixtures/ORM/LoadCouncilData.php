<?php
namespace SCSS\OrganizationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\OrganizationBundle\Entity\Organization;

class LoadCouncilData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ptc = new Council();
        $ptc->setName('pine tree council');
        $ptc->setDescription('ptc');
        $manager->persist($ptc);
        $this->addReference('bsa-ptc');

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}