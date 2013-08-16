<?php
/**
 * User: nikk
 * Date: 6/19/13
 * Time: 2:43 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ps\AppBundle\Classes\MysqlDateTime;
use Ps\AppBundle\Entity;

class EventRepository extends EntityRepository
{
    /**
     * Find events, that did not happened
     * @param string $sport
     * @return Entity\Event[]
     */
    public function findActualEvents($sport)
    {
        return $this
            ->createQueryBuilder('e')
            ->innerJoin('PsAppBundle:Sport', 's', 'WITH', 'e.sport = s.id')
            ->where('e.dateStart > :now')
            ->andWhere('s.title = :sport')
            ->setParameter('now', new MysqlDateTime())
            ->setParameter('sport', $sport)
            ->orderBy('e.dateStart', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $title
     * @return Entity\Event
     */
    public function findEventByTitle($title)
    {
        return $this
            ->createQueryBuilder('e')
            ->where('e.title = :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getSingleResult();
    }
}