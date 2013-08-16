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
        $eventOckb->setTitle('public');
        $eventOckb->setOrganizer($this->getReference('user.superAdmin'));
        $eventOckb->setDayStart('Mon');
        $eventOckb->setTimeStart('19:30');
        $eventOckb->setDayEnd('Mon');
        $eventOckb->setTimeEnd('21:00');
        $eventOckb->setPlace($this->getReference('place.ockb'));
        $eventOckb->setMemberLimit(15);
        $eventOckb->setPrivacy($this->getReference('eventPrivacy.public'));
        $eventOckb->setSport($this->getReference('sport.football'));

        $manager->persist($eventOckb);

        $eventOckbPrivate = new RegularEvent();
        $eventOckbPrivate->setTitle('private');
        $eventOckbPrivate->setOrganizer($this->getReference('user.superAdmin'));
        $eventOckbPrivate->setDayStart('Mon');
        $eventOckbPrivate->setTimeStart('19:30');
        $eventOckbPrivate->setDayEnd('Mon');
        $eventOckbPrivate->setTimeEnd('21:00');
        $eventOckbPrivate->setPlace($this->getReference('place.ockb'));
        $eventOckbPrivate->setMemberLimit(15);
        $eventOckbPrivate->setPrivacy($this->getReference('eventPrivacy.private'));
        $eventOckbPrivate->setSport($this->getReference('sport.football'));

        $manager->persist($eventOckbPrivate);

        $eventOckbLimitReached = new RegularEvent();
        $eventOckbLimitReached->setTitle('limitReached');
        $eventOckbLimitReached->setOrganizer($this->getReference('user.superAdmin'));
        $eventOckbLimitReached->setDayStart('Mon');
        $eventOckbLimitReached->setTimeStart('19:30');
        $eventOckbLimitReached->setDayEnd('Mon');
        $eventOckbLimitReached->setTimeEnd('21:00');
        $eventOckbLimitReached->setPlace($this->getReference('place.ockb'));
        $eventOckbLimitReached->setMemberLimit(0);
        $eventOckbLimitReached->setPrivacy($this->getReference('eventPrivacy.public'));
        $eventOckbLimitReached->setSport($this->getReference('sport.football'));

        $manager->persist($eventOckbLimitReached);

        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}