<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 4:06 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\Place;

class PlaceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $placeOckb = new Place();
        $placeOckb->setTitle('Спорт комплекс возле ОЦКБ');
        $placeOckb->setCity($this->getReference('city-donetsk'));
        $manager->persist($placeOckb);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}