<?php
/**
 * User: nikk
 * Date: 7/1/14
 * Time: 1:01 PM
 */

namespace Ps\SlavsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ps\AppBundle\Entity;
use Ps\SlavsBundle\Entity\Slavs;

class SlavsRepository extends EntityRepository
{
    /**
     * @param string $order
     * @param string $direction
     *
     * @return Slavs[]
     */
    public function findAllOrdered($order, $direction = 'ASC')
    {
        return $this
            ->createQueryBuilder('s')
            ->orderBy('s.' . $order, $direction)
            ->getQuery()
            ->getResult();
    }
}