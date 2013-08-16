<?php
/**
 * User: nikk
 * Date: 8/6/13
 * Time: 12:32 PM
 */

namespace Ps\FrontBundle\Tests\Controller;

use Ps\AppBundle\Tests\BaseTestCase;
use Ps\AppBundle\Controller\GetContainerTrait;
use Ps\AppBundle\Model\EventMemberModel;
use Ps\AppBundle\Entity;

class AbstractEventTest extends BaseTestCase
{
    use GetContainerTrait;

    /**
     * Test when user participate himself
     */
    public function testUserParticipation()
    {
        $this->refreshDb();

        $this->runConsole('ps:app:create-regular-events', ['--day' => 'mon']);

        $this->loginByUsername('kalinick');
        $oUser = $this->getSecurityContext()->getToken()->getUser();

        $this->userParticipationPublicEventsTest($oUser);
        $this->userParticipationPrivateEventsTest($oUser);
    }

    /**
     * @return array
     */
    private function getBlankMetric() {
        return [
            EventMemberModel::PARTICIPATE_YES => 0,
            EventMemberModel::PARTICIPATE_NO => 0,
            EventMemberModel::PARTICIPATE_WISH => 0,
        ];
    }

    /**
     * @param Entity\User $oUser
     */
    private function userParticipationPublicEventsTest($oUser)
    {
        $oEvent = $this->getEventManager()->getEventByTitle('public');

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_YES, $oUser);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_YES] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_NO, $oUser);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);
    }

    /**
     * @param Entity\User $oUser
     */
    private function userParticipationPrivateEventsTest($oUser)
    {
        $oEvent = $this->getEventManager()->getEventByTitle('private');

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_YES, $oUser);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_WISH] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_NO, $oUser);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);
    }

    /**
     * @expectedException \Ps\AppBundle\Exception\EventMemberException
     * @expectedExceptionMessage event_members.rich_limit
     */
    public function testUserParticipationLimitReached()
    {
        $this->loginByUsername('kalinick');
        $oUser = $this->getSecurityContext()->getToken()->getUser();
        $oEvent = $this->getEventManager()->getEventByTitle('limitReached');

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_NO, $oUser);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);

        $this->getEventMemberManager()->participateUser($oEvent, EventMemberModel::PARTICIPATE_YES, $oUser);
    }

    /**
     * Test when user participate his friend
     */
    public function testUserFriendParticipation()
    {
        $this->loginByUsername('kalinick');
        $oUser = $this->getSecurityContext()->getToken()->getUser();
        $sFriendName = 'friend';

        $this->userFriendParticipationPublicEventsTest($oUser, $sFriendName);
        $this->userFriendParticipationPrivateEventsTest($oUser, $sFriendName);
    }

    /**
     * @param Entity\User $oUser
     * @param string $sFriendName
     * @throws \Exception
     */
    private function userFriendParticipationPublicEventsTest($oUser, $sFriendName)
    {
        $oEvent = $this->getEventManager()->getEventByTitle('public');

        $this->getEventMemberManager()->participateUserFriend(
            $oEvent, EventMemberModel::PARTICIPATE_YES, $oUser, $sFriendName);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_YES] = 1;
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);

        if ($this->getUserFriendManager()->getUserFriendByName($oUser, $sFriendName) == null) {
            throw new \Exception('User friend not found');
        }

        $this->getEventMemberManager()->participateUserFriend(
            $oEvent, EventMemberModel::PARTICIPATE_NO, $oUser,$sFriendName);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 2;
        $this->assertTrue($aMetric == $aExpectedMetric);
    }

    /**
     * @param Entity\User $oUser
     * @param string $sFriendName
     */
    private function userFriendParticipationPrivateEventsTest($oUser, $sFriendName)
    {
        $oEvent = $this->getEventManager()->getEventByTitle('private');

        $this->getEventMemberManager()->participateUserFriend(
            $oEvent, EventMemberModel::PARTICIPATE_YES, $oUser, $sFriendName);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_WISH] = 1;
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 1;
        $this->assertTrue($aMetric == $aExpectedMetric);

        $this->getEventMemberManager()->participateUserFriend(
            $oEvent, EventMemberModel::PARTICIPATE_NO, $oUser, $sFriendName);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 2;
        $this->assertTrue($aMetric == $aExpectedMetric);
    }

    /**
     * Test when participate anonymous
     */
    public function testAnonymousParticipationPublicEvent()
    {
        $oEvent = $this->getEventManager()->getEventByTitle('public');
        $sName = 'Me';

        $oMember = $this->getEventMemberManager()->participateAnonymous(
            $oEvent, EventMemberModel::PARTICIPATE_YES, null, $sName);
        $anonymousId = $oMember->getId();
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_YES] = 1;
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 2;
        $this->assertTrue($aMetric == $aExpectedMetric);

        $this->getEventMemberManager()->participateAnonymous(
            $oEvent, EventMemberModel::PARTICIPATE_NO, $anonymousId, $sName);
        $aMetric = $this->getEventMemberManager()->countEventParticipation($oEvent);
        $aExpectedMetric = $this->getBlankMetric();
        $aExpectedMetric[EventMemberModel::PARTICIPATE_NO] = 3;
        $this->assertTrue($aMetric == $aExpectedMetric);
    }

    /**
     * @expectedException \Ps\AppBundle\Exception\EventMemberException
     * @expectedExceptionMessage event_participation.impossible
     */
    public function testAnonymousParticipationPrivateEvent()
    {
        $oEvent = $this->getEventManager()->getEventByTitle('private');
        $sName = 'Me';

        $this->getEventMemberManager()->participateAnonymous(
            $oEvent, EventMemberModel::PARTICIPATE_YES, null, $sName);
    }
}