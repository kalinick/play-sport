<?php
/**
 * User: nikk
 * Date: 8/1/13
 * Time: 11:12 AM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\EventMemberParticipation;

class EventMemberParticipationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $partYes = new EventMemberParticipation();
        $partYes->setTitle('yes');
        $manager->persist($partYes);

        $partNo = new EventMemberParticipation();
        $partNo->setTitle('no');
        $manager->persist($partNo);

        $partWish = new EventMemberParticipation();
        $partWish->setTitle('wish');
        $manager->persist($partWish);

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }
}