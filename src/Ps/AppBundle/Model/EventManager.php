<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 4:28 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Ps\AppBundle\Entity;

class EventManager extends EventModel
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
        $this->repository = $this->doctrine->getRepository('PsAppBundle:Event');
    }

    /**
     * @param int $id
     * @return Entity\Event
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getEventById($id)
    {
        $oEvent = $this->repository->find($id);
        if ($oEvent instanceof Entity\Event) {
            return $oEvent;
        }

        throw new NotFoundHttpException('Not found event id ' . $id);
    }
}