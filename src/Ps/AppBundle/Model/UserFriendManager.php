<?php
/**
 * User: nikk
 * Date: 6/18/13
 * Time: 4:29 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Ps\AppBundle\Entity;
use Ps\AppBundle\Repository;

class UserFriendManager extends UserFriendModel
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var Repository\UserFriendRepository
     */
    private $repository;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository('PsAppBundle:UserFriend');
    }

    /**
     * @param Entity\User $oUser
     * @return Entity\UserFriend[]
     */
    public function getUserFriends(Entity\User $oUser)
    {
        return $this->repository->findByUser($oUser);
    }

    /**
     * @param Entity\User $oUser
     * @param string $title
     */
    /**
     * @param Entity\User $oUser
     * @param string $title
     * @return Entity\UserFriend|null
     */
    public function getUserFriendByName(Entity\User $oUser, $title)
    {
        return $this->repository->findOneOrNullByUserAndTitle($oUser, $title);
    }

    /**
     * @param Entity\User $oUser
     * @param string $title
     * @return Entity\UserFriend
     */
    public function createIfNotExist(Entity\User $oUser, $title)
    {
        $oUserFriend = $this->repository->findOneOrNullByUserAndTitle($oUser, $title);

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