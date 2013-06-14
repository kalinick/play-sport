<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 3:27 PM
 */

namespace Ps\AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ps\AppBundle\Entity\User;

class UserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $mainUser = new User();
        $mainUser->setEmail("kalinick@gmail.com");
        $mainUser->setEmailCanonical("kalinick@gmail.com");
        $mainUser->setUsername("kalinick");
        $mainUser->setUsernameCanonical("kalinick");
        $mainUser->setEnabled(true);
        $mainUser->setLocked(false);
        $mainUser->setPlainPassword("freedom");
        $mainUser->setRoles(['ROLE_SUPER_ADMIN']);
        $mainUser->setCity($this->getReference('city-donetsk'));
        $manager->persist($mainUser);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}