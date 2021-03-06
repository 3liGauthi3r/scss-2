<?php
namespace SCSS\UtilityBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SCSS\UtilityBundle\Entity\Address;

class LoadAddressData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $geo = $this->container->get('ivory_google_map.geocoder');

        // hinds
        $hinds = new Address();
        $hinds->setName('hinds physical');
        $hinds->setStreet('79 Plains Rd');
        $hinds->setCity('Raymond');
        $hinds->setZone('Maine');
        $result = $geo->geocode($hinds->getCity().' '.$hinds->getZone());
        $hinds->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $hinds->setLongitude($result->getGeometry()->getLocation()->getLongitude());
        $manager->persist($hinds);
        $this->addReference('address-hinds', $hinds);

        // bomazeen
        $bomazeen = new Address();
        $bomazeen->setName('bomazeen physical');
        $bomazeen->setStreet('123 easy st');
        $bomazeen->setCity('belgrade');
        $bomazeen->setZone('Maine');
        $result = $geo->geocode($bomazeen->getCity().' '.$bomazeen->getZone());
        $bomazeen->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $bomazeen->setLongitude($result->getGeometry()->getLocation()->getLongitude());
        $manager->persist($bomazeen);
        $this->addReference('address-bomazeen', $bomazeen);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
