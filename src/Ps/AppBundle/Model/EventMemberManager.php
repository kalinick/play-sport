<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 5:37 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

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

    /**
     * @var UserFriendManager
     */
    private $userFriendManager;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository('PsAppBundle:EventMember');
    }

    /**
     * @param UserFriendManager $userFriendManager
     */
    public function setUserFriendManager(UserFriendManager $userFriendManager)
    {
        $this->userFriendManager = $userFriendManager;
    }

    /**
     * @return UserFriendManager
     */
    public function getUserFriendManager()
    {
        return $this->userFriendManager;
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @return bool
     */
    public function isUserExist(Entity\Event $oEvent, Entity\User $oUser)
    {
        $this->_tempUserId = $oUser->getId();

        return $oEvent->getEventMembers()->exists(function($key, Entity\EventMember $eventMember){
            return $eventMember->getUser() !== null &&
                $eventMember->getUser()->getId() == $this->_tempUserId;
        });
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @return bool
     */
    public function isUserParticipate(Entity\Event $oEvent, Entity\User $oUser)
    {
        $this->_tempUserId = $oUser->getId();

        return $oEvent->getEventMembers()->exists(function($key, Entity\EventMember $eventMember){
            return $eventMember->getUser() !== null &&
                ($eventMember->getUser()->getId() == $this->_tempUserId) &&
                $eventMember->getParticipate() == self::PARTICIPATE_YES;
        });
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @param int $participate
     * @throws \Symfony\Component\HttpKernel\Exception\ConflictHttpException
     */
    public function participateUser(Entity\Event $oEvent, Entity\User $oUser, $participate)
    {
        if (!in_array($participate, self::getParticipateList(), true)) {
            throw new ConflictHttpException('Participate ' . $participate . ' not exists');
        }

        if ($this->isUserExist($oEvent, $oUser)) {
            $this->_tempUserId = $oUser->getId();
            $this->_tempParticipate = $participate;
            $oEvent->getEventMembers()->map(function(Entity\EventMember $eventMember){
                if ($eventMember->getUser() !== null && $eventMember->getUser()->getId() == $this->_tempUserId) {
                    $eventMember->setParticipate($this->_tempParticipate);
                }
            });
        } else {
            $oEventMember = new Entity\EventMember();
            $oEventMember->setEvent($oEvent);
            $oEventMember->setUser($oUser);
            $oEventMember->setParticipate($participate);
            $this->doctrine->getManager()->persist($oEventMember);
        }

        $this->doctrine->getManager()->flush();
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @param $title
     * @param $participate
     */
    public function participateUserFriend(Entity\Event $oEvent, Entity\User $oUser, $title, $participate)
    {
        $manager = $this->doctrine->getManager();
        $oUserFriend = $this->getUserFriendManager()->createIfNotExist($oUser, $title);

        $criteria = ['event' => $oEvent->getId(), 'userFriend' => $oUserFriend->getId()];
        $oEventMember = $this->repository->findOneBy($criteria);
        if ($oEventMember === null) {
            $oEventMember = new Entity\EventMember();
            $oEventMember->setEvent($oEvent);
            $oEventMember->setUserFriend($oUserFriend);

            $manager->persist($oEventMember);
        }
        $oEventMember->setParticipate($participate);

        $manager->flush();
    }

    /**
     * @param Entity\Event $oEvent
     * @param $anonymousId
     * @param $title
     * @param $participate
     * @return Entity\EventMember
     */
    public function participateAnonymous(Entity\Event $oEvent, $anonymousId, $title, $participate)
    {
        $manager = $this->doctrine->getManager();

        if ($anonymousId !== null) {
            $oEventMember = $this->getAnonymousMemberById($anonymousId);
        }

        if (!empty($oEventMember)) {
            if (!empty($title)) {
                $oEventMember->setTitle($title);
            }
        } else {
            $oEventMember = new Entity\EventMember();
            $oEventMember->setEvent($oEvent);
            $oEventMember->setTitle($title);
            $manager->persist($oEventMember);
        }

        $oEventMember->setParticipate($participate);
        $manager->flush();

        return $oEventMember;
    }

    /**
     * @param int $id
     * @return Entity\EventMember
     */
    public function getMemberById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $anonymousId
     * @return Entity\EventMember
     * @throws \Symfony\Component\HttpKernel\Exception\ConflictHttpException
     */
    public function getAnonymousMemberById($anonymousId)
    {
        $oMember = $this->getMemberById($anonymousId);
        if ($oMember->getUser() !== null || $oMember->getUserFriend() !== null) {
            throw new ConflictHttpException();
        }
        return $oMember;
    }
}