<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 3:54 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\Sport;

class SportData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sportFootball = new Sport();
        $sportFootball->setTitle('football');
        $manager->persist($sportFootball);

        $manager->flush();

        $this->addReference('sport.football', $sportFootball);
    }

    public function getOrder()
    {
        return 1;
    }
}