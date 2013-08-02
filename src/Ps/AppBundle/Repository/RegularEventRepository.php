<?php
/**
 * User: nikk
 * Date: 7/11/13
 * Time: 10:55 AM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RegularEventRepository extends EntityRepository
{
    /**
     * Find events, that start of input day of week
     * @param string $day - day of week
     * @return array
     */
    public function findEventsByDayStart($day)
    {
        return $this
            ->createQueryBuilder('re')
            ->where('re.dayStart = :day')
            ->setParameter('day', $day)
            ->getQuery()
            ->getResult();
    }
}