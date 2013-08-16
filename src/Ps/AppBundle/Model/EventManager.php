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
use Ps\AppBundle\Repository;

class EventManager extends EventModel
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var Repository\EventRepository
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
     * @throws NotFoundHttpException
     */
    public function getEventById($id)
    {
        $oEvent = $this->repository->find($id);
        if ($oEvent instanceof Entity\Event) {
            return $oEvent;
        }

        throw new NotFoundHttpException('Not found event id ' . $id);
    }

    /**
     * Find events that not pass, for input sport
     * @param string $sport
     * @return Entity\Event[]
     */
    public function getActualEvents($sport)
    {
        return $this->repository->findActualEvents($sport);
    }

    /**
     * @param $title
     * @return Entity\Event
     */
    public function getEventByTitle($title)
    {
        return $this->repository->findEventByTitle($title);
    }
}