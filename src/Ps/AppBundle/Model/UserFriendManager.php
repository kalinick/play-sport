<?php
/**
 * User: nikk
 * Date: 6/18/13
 * Time: 4:29 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Ps\AppBundle\Entity;

class UserFriendManager extends UserFriendModel
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository('PsAppBundle:UserFriend');
    }

    /**
     * @param Entity\User $user
     * @return array
     */
    public function getFriends(Entity\User $user)
    {
        return $this->repository->findBy(['user' => $user->getId()]);
    }

    /**
     * @param Entity\User $oUser
     * @param string $title
     * @return Entity\UserFriend
     */
    public function createIfNotExist(Entity\User $oUser, $title)
    {
        $oUserFriend = $this->repository->findOneBy(['user' => $oUser->getId(), 'title' => $title]);
        if ($oUserFriend === null) {
            $oUserFriend = new Entity\UserFriend();
            $oUserFriend->setTitle($title);
            $oUserFriend->setUser($oUser);

            $manager = $this->doctrine->getManager();
            $manager->persist($oUserFriend);
            $manager->flush();
        }

        return $oUserFriend;
    }
}