<?php
/**
 * User: nikk
 * Date: 7/31/13
 * Time: 11:43 AM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\EventPrivacy;

class EventPrivacyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $privacyPublic = new EventPrivacy();
        $privacyPublic->setTitle('public');
        $manager->persist($privacyPublic);

        $privacyPrivate = new EventPrivacy();
        $privacyPrivate->setTitle('private');
        $manager->persist($privacyPrivate);

        $manager->flush();

        $this->addReference('eventPrivacy.public', $privacyPublic);
        $this->addReference('eventPrivacy.private', $privacyPrivate);
    }

    public function getOrder()
    {
        return 1;
    }
}