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
    }

    public function getOrder()
    {
        return 3;
    }
}