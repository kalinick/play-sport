<?php
/**
 * User: nikk
 * Date: 8/1/13
 * Time: 1:41 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ps\AppBundle\Entity;

class EventMemberParticipationRepository extends EntityRepository
{
    /**
     * @param $title
     * @return Entity\EventMemberParticipation
     */
    public function findOneByTitle($title)
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.title = :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getSingleResult();
    }
}