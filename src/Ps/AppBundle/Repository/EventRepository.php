<?php
/**
 * User: nikk
 * Date: 6/19/13
 * Time: 2:43 PM
 */

namespace Ps\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class EventRepository extends EntityRepository
{
    public function findActualEvents()
    {
        return $this
            ->createQueryBuilder('e')
            ->where('e.dateStart > :now')
            ->setParameter('now', time())
            ->orderBy('e.dateStart', 'ASC')
            ->getQuery()
            ->getResult();
    }
}