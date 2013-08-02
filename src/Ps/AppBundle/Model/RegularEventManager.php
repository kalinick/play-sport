<?php
/**
 * User: nikk
 * Date: 7/10/13
 * Time: 1:24 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Ps\AppBundle\Entity\Event;
use Ps\AppBundle\Entity\RegularEvent;
use Ps\AppBundle\Repository;

class RegularEventManager extends RegularEventModel
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var Repository\RegularEventRepository
     */
    private $repository;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository('PsAppBundle:RegularEvent');
    }

    /**
     * Create regular events by day
     *
     * @param string $day
     * @return int
     */
    public function createEvents($day)
    {
        $regularEvents = $this->repository->findEventsByDayStart($day);
        $dm = $this->doctrine->getManager();

        /* @var RegularEvent $regularEvent*/
        foreach($regularEvents as $regularEvent) {
            $dateStart = new \DateTime('next ' . $regularEvent->getDayStart() . ' ' . $regularEvent->getTimeStart());
            $dateEnd = new \DateTime('next ' . $regularEvent->getDayEnd() . ' ' . $regularEvent->getTimeEnd());

            $event = new Event();
            $event->setTitle($regularEvent->getTitle());
            $event->setOrganizer($regularEvent->getOrganizer());
            $event->setPlace($regularEvent->getPlace());
            $event->setDateStart($dateStart);
            $event->setDateEnd($dateEnd);
            $event->setPrivacy($regularEvent->getPrivacy());
            $event->setMemberLimit($regularEvent->getMemberLimit());

            $dm->persist($event);
        }

        $dm->flush();
        return count($regularEvents);
    }
}