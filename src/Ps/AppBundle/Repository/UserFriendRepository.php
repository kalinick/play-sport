<?php
/**
 * User: nikk
 * Date: 8/1/13
 * Time: 3:22 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Ps\AppBundle\Entity;

class UserFriendRepository extends EntityRepository
{
    /**
     * @param Entity\User $oUser
     * @param $title
     * @return Entity\UserFriend|null
     */
    public function findOneOrNullByUserAndTitle(Entity\User $oUser, $title)
    {
        return $this
            ->createQueryBuilder('uf')
            ->where('uf.user = :user')
            ->andWhere('uf.title = :title')
            ->setParameter('user', $oUser->getId())
            ->setParameter('title', $title)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Entity\User $oUser
     * @return Entity\UserFriend[]
     */
    public function findByUser(Entity\User $oUser)
    {
        return $this
            ->createQueryBuilder('uf')
            ->where('uf.user = :user')
            ->setParameter('user', $oUser->getId())
            ->getQuery()
            ->getResult();
    }
}