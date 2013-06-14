<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 3:44 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\City;

class CityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cityDonetsk = new City();
        $cityDonetsk->setTitle('donetsk');
        $manager->persist($cityDonetsk);

        $manager->flush();

        $this->addReference('city-donetsk', $cityDonetsk);
    }

    public function getOrder()
    {
        return 1;
    }
}