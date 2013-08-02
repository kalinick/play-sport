<?php
/**
 * User: nikk
 * Date: 8/1/13
 * Time: 1:02 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ps\AppBundle\Entity;
use Ps\AppBundle\Model\EventMemberModel;

class EventMemberRepository extends EntityRepository
{
    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @return Entity\EventMember|null
     */
    public function findOneOrNullMemberByUser(Entity\Event $oEvent, Entity\User $oUser)
    {
        return $this
            ->createQueryBuilder('em')
            ->where('em.event = :event')
            ->andWhere('em.user = :user')
            ->setParameter('event', $oEvent->getId())
            ->setParameter('user', $oUser->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\UserFriend $oUserFriend
     * @return Entity\EventMember|null
     */
    public function findOneOrNullMemberByUserFriend(Entity\Event $oEvent, Entity\UserFriend $oUserFriend)
    {
        return $this
            ->createQueryBuilder('em')
            ->where('em.event = :event')
            ->andWhere('em.userFriend = :userFriend')
            ->setParameter('event', $oEvent->getId())
            ->setParameter('userFriend', $oUserFriend->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Entity\Event $oEvent
     * @return int
     */
    public function countEventMembers(Entity\Event $oEvent)
    {
        return $this
            ->createQueryBuilder('em')
            ->select('count(em.id)')
            ->innerJoin('PsAppBundle:EventMemberParticipation', 'emp', 'WITH', 'em.participation = emp.id')
            ->where('em.event = :event')
            ->andWhere('emp.title = :participation')
            ->setParameter('event', $oEvent->getId())
            ->setParameter('participation', EventMemberModel::PARTICIPATE_YES)
            ->getQuery()
            ->getSingleScalarResult();
    }
}