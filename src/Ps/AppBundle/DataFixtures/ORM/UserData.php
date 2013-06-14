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
        $superAdmin = new User();
        $superAdmin->setEmail("kalinick@gmail.com");
        $superAdmin->setEmailCanonical("kalinick@gmail.com");
        $superAdmin->setUsername("kalinick");
        $superAdmin->setUsernameCanonical("kalinick");
        $superAdmin->setEnabled(true);
        $superAdmin->setLocked(false);
        $superAdmin->setPlainPassword("freedom");
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $superAdmin->setCity($this->getReference('city-donetsk'));
        $manager->persist($superAdmin);

        $manager->flush();

        $this->addReference('super-admin', $superAdmin);
    }

    public function getOrder()
    {
        return 2;
    }
}