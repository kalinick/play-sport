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
        $placeOckb->setImageFilename('ce8e0053f9ee2c2fe242df3a6ae1483504b64caa.png');
        $placeOckb->setCity($this->getReference('city.donetsk'));
        $manager->persist($placeOckb);

        $manager->flush();

        $this->addReference('place.ockb', $placeOckb);
    }

    public function getOrder()
    {
        return 2;
    }
}