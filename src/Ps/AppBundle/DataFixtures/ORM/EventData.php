<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:26 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\Event;

class EventData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $eventOckb = new Event();
        $eventOckb->setTitle('Спорт комплекс возле ОЦКБ Понедельник');
        $eventOckb->setDateStart(new \DateTime('17.06.2013 19:30:00'));
        $eventOckb->setDateEnd(new \DateTime('17.06.2013 21:00:00'));
        $eventOckb->setOrganizer($this->getReference('super-admin'));

        $manager->persist($eventOckb);

        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}