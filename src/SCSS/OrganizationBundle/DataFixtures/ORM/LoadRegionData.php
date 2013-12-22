<?php
namespace SCSS\GeographyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SCSS\GeographyBundle\Entity\Region;

class LoadRegionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $geo = $this->container->get('ivory_google_map.geocoder');

        // Casco Bay District
        $result = $geo->gecode('Portland Maine');
        $CB = new Region();
        $CB->setName('casco bay district');
        $CB->setOrganization($this->getReference('bsa'));
        $CB->setCouncil($this->getReference('bsa-ptc'));
        $CB->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $CB->setLogitude($result->getGeometry()->getLocation()->getLogitude());
        $manager->persist($CB);
        $this->setReference('casco-bay', $CB);

        $manager->flush();
    }

    public function getOrder() 
    { 
        return 3; 
    }
}
