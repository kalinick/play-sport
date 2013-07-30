<?php
/**
 * User: nikk
 * Date: 7/10/13
 * Time: 1:17 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\RegularEvent;

class RegularEventData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $eventOckb = new RegularEvent();
        $eventOckb->setTitle('Спорт комплекс возле ОЦКБ');
        $eventOckb->setOrganizer($this->getReference('super-admin'));
        $eventOckb->setDayStart('Mon');
        $eventOckb->setTimeStart('19:30');
        $eventOckb->setDayEnd('Mon');
        $eventOckb->setTimeEnd('21:00');
        $eventOckb->setPlace($this->getReference('place-ockb'));

        $manager->persist($eventOckb);

        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}