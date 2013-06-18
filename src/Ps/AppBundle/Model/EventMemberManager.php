<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 5:37 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Ps\AppBundle\Entity;

class EventMemberManager extends EventMemberModel
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
     * @param Entity\Event $event
     * @param Entity\User $user
     * @return bool
     */
    public function isUserExist(Entity\Event $event, Entity\User $user)
    {
        $this->_tempUserId = $user->getId();

        return $event->getEventMembers()->exists(function($key, Entity\EventMember $eventMember){
            return $eventMember->getUser()->getId() == $this->_tempUserId;
        });
    }

    /**
     * @param Entity\Event $event
     * @param Entity\User $user
     * @return bool
     */
    public function isUserParticipate(Entity\Event $event, Entity\User $user)
    {
        $this->_tempUserId = $user->getId();

        return $event->getEventMembers()->exists(function($key, Entity\EventMember $eventMember){
            return ($eventMember->getUser()->getId() == $this->_tempUserId) &&
                $eventMember->getParticipate() == self::PARTICIPATE_YES;
        });
    }

    /**
     * @param Entity\Event $event
     * @param Entity\User $user
     * @param int $participate
     */
    public function participateUser(Entity\Event $event, Entity\User $user, $participate)
    {
        if (!in_array($participate, self::getParticipateList())) {
            throw new ConflictHttpException('Participate ' . $participate . ' not exists');
        }

        if ($this->isUserExist($event, $user)) {
            $this->_tempUserId = $user->getId();
            $this->_tempParticipate = $participate;
            $event->getEventMembers()->map(function(Entity\EventMember $eventMember){
                if ($eventMember->getUser()->getId() == $this->_tempUserId) {
                    $eventMember->setParticipate($this->_tempParticipate);
                }
            });
        } else {
            $oEventMember = new Entity\EventMember();
            $oEventMember->setEvent($event);
            $oEventMember->setUser($user);
            $oEventMember->setParticipate($participate);
            $this->doctrine->getManager()->persist($oEventMember);
        }

        $this->doctrine->getManager()->flush();
    }
}