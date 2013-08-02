<?php
/**
 * User: nikk
 * Date: 6/19/13
 * Time: 2:43 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ps\AppBundle\Classes\MysqlDateTime;

class EventRepository extends EntityRepository
{
    /**
     * Find events, that did not happened
     * @return array
     */
    public function findActualEvents()
    {
        return $this
            ->createQueryBuilder('e')
            ->where('e.dateStart > :now')
            ->setParameter('now', new MysqlDateTime())
            ->orderBy('e.dateStart', 'ASC')
            ->getQuery()
            ->getResult();
    }
}