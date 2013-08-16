<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 5:37 PM
 */

namespace Ps\AppBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Ps\AppBundle\Entity;
use Ps\AppBundle\Repository;
use Ps\AppBundle\Exception\EventMemberException;

class EventMemberManager extends EventMemberModel
{
    /**
     * @var Repository\EventMemberRepository
     */
    private $repository;

    /**
     * @var UserFriendManager
     */
    private $userFriendManager;

    public function __construct(Registry $doctrine)
    {
        parent::__construct($doctrine);
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
     * @param string $participate
     * @param Entity\User $oUser
     */
    public function participateUser(Entity\Event $oEvent, $participate, Entity\User $oUser)
    {
        $oMember = $this->repository->findOneOrNullMemberByUser($oEvent, $oUser);
        if ($oMember !== null && $oMember->getParticipation()->getTitle() === $participate) {
            return;
        }

        $oParticipation = $this->getParticipation($oEvent, $participate, $oUser);
        if ($oParticipation->getTitle() == self::PARTICIPATE_YES) {
            $this->checkMembersLimit($oEvent);
        }

        if ($oMember === null) {
            $oMember = new Entity\EventMember();
            $oMember->setEvent($oEvent);
            $oMember->setUser($oUser);
            $this->doctrine->getManager()->persist($oMember);

            $oEvent->addEventMember($oMember);
        }
        $oMember->setParticipation($oParticipation);

        $this->doctrine->getManager()->flush();
    }

    /**
     * @param Entity\Event $oEvent
     * @param string $participate
     * @param Entity\User $oUser
     * @param string $title
     */
    public function participateUserFriend(Entity\Event $oEvent, $participate, Entity\User $oUser, $title)
    {
        $oUserFriend = $this->getUserFriendManager()->createIfNotExist($oUser, $title);

        $oMember = $this->repository->findOneOrNullMemberByUserFriend($oEvent, $oUserFriend);
        if ($oMember !== null && $oMember->getParticipation()->getTitle() === $participate) {
            return;
        }

        $oParticipation = $this->getParticipation($oEvent, $participate, $oUser);
        if ($oParticipation->getTitle() == self::PARTICIPATE_YES) {
            $this->checkMembersLimit($oEvent);
        }

        if ($oMember === null) {
            $oMember = new Entity\EventMember();
            $oMember->setEvent($oEvent);
            $oMember->setUserFriend($oUserFriend);

            $this->doctrine->getManager()->persist($oMember);
        }
        $oMember->setParticipation($oParticipation);

        $this->doctrine->getManager()->flush();
    }

    /**
     * @param Entity\Event $oEvent
     * @param string $participate
     * @param int $anonymousId
     * @param string $title
     * @return Entity\EventMember
     */
    public function participateAnonymous(Entity\Event $oEvent, $participate, $anonymousId, $title)
    {
        if ($anonymousId !== null) {
            $oMember = $this->getAnonymousMemberById($anonymousId);
        }

        if (!empty($oMember) && $oMember->getParticipation()->getTitle() === $participate) {
            return $oMember;
        }

        $oParticipation = $this->getParticipation($oEvent, $participate);
        if ($oParticipation->getTitle() == self::PARTICIPATE_YES) {
            $this->checkMembersLimit($oEvent);
        }

        if (empty($oMember)) {
            $oMember = new Entity\EventMember();
            $oMember->setEvent($oEvent);
            $oMember->setTitle('anonymous');
            $this->doctrine->getManager()->persist($oMember);
        }

        if (!empty($title)) {
            $oMember->setTitle($title);
        }

        $oMember->setParticipation($oParticipation);
        $this->doctrine->getManager()->flush();

        return $oMember;
    }

    /**
     * @param Entity\Event $oEvent
     * @throws EventMemberException
     */
    public function checkMembersLimit(Entity\Event $oEvent)
    {
        if ($oEvent->getMemberLimit() === null) {
            return;
        }
        $nMembers = $this->repository->countEventMembers($oEvent);

        if ($nMembers >= $oEvent->getMemberLimit()) {
            throw new EventMemberException('event_members.rich_limit');
        }
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
     * @param int $anonymousId
     * @return Entity\EventMember
     * @throws BadRequestHttpException
     */
    public function getAnonymousMemberById($anonymousId)
    {
        $oMember = $this->getMemberById($anonymousId);
        if ($oMember->getUser() !== null || $oMember->getUserFriend() !== null) {
            throw new BadRequestHttpException();
        }
        return $oMember;
    }

    /**
     * @param Entity\Event $oEvent
     * @param Entity\User $oUser
     * @return null|Entity\EventMemberParticipation
     */
    public function getUserParticipation(Entity\Event $oEvent, Entity\User $oUser)
    {
        $oMember = $this->repository->findOneOrNullMemberByUser($oEvent, $oUser);
        if ($oMember === null) {
            return null;
        }
        return $oMember->getParticipation();
    }

    /**
     * @param Entity\Event $oEvent
     * @return array
     */
    public function countEventParticipation(Entity\Event $oEvent)
    {
        $metric = [self::PARTICIPATE_YES => 0, self::PARTICIPATE_NO => 0, self::PARTICIPATE_WISH => 0];
        foreach($oEvent->getEventMembers() as $member) {
            $metric[$member->getParticipation()->getTitle()]++;
        }

        return $metric;
    }
}