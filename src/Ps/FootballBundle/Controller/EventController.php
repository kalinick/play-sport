<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:12 PM
 */

namespace Ps\FootballBundle\Controller;

use Ps\AppBundle\Model\EventMemberModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Ps\AppBundle\Entity\EventMember;
use Ps\AppBundle\Controller\GetContainerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EventController extends Controller
{
    use GetContainerTrait;

    /**
     * @Route("/event/{id}", name="football_event_index")
     * @Template()
     */
    public function indexAction($id)
    {
        $oEvent = $this->getEventManager()->getEventById($id);

        $user = ['friends' => '', 'exist' => false];
        $user['authorized'] = $this->getSecurityContext()->isGranted('ROLE_USER');
        if ($this->getSecurityContext()->isGranted('ROLE_USER')) {
            $oUser = $this->getSecurityContext()->getToken()->getUser();
            $user['exist'] = $this->getEventMemberManager()->isUserExist($oEvent, $oUser);
            $user['participate'] = $this->getEventMemberManager()->isUserParticipate($oEvent, $oUser);
            $user['friends'] = $this->friendsToString($this->getUserFriendManager()->getFriends($oUser));
        }
        $metric = ['part' => 0, 'unpart' => 0];

        foreach($oEvent->getEventMembers() as $member) {
            if ($member->getParticipate()) {
                $metric['part']++;
            } else {
                $metric['unpart']++;
            }
        }

        return [
            'event' => $oEvent,
            'user' => $user,
            'metric' => $metric
        ];
    }

    /**
     * @param array $friends
     * @return string
     */
    private function friendsToString(array $friends)
    {
        $result = '';
        foreach($friends as $friend) {
            $result .= '"' . $friend->getTitle() . '", ';
        }
        return substr($result, 0, -2);
    }

    /**
     * @Route("/event/{id}/participate-user", name="football_event_participate_user")
     * @Method({"POST"})
     * @Template()
     */
    public function participateUserAction($id)
    {
        $oEvent = $this->getEventManager()->getEventById($id);
        $oUser = $this->getSecurityContext()->getToken()->getUser();

        $participate = $this->getRequest()->get('participate') ?
            EventMemberModel::PARTICIPATE_YES : EventMemberModel::PARTICIPATE_NO;

        $this->getEventMemberManager()->participateUser($oEvent, $oUser, $participate);
        return new RedirectResponse($this->generateUrl('football_event_index', ['id' => $id]));
    }

    /**
     * @Route("/event/{id}/participate-friend", name="football_event_participate_friend")
     * @Method({"POST"})
     * @Template()
     */
    public function participateFriendAction($id)
    {
        $title = $this->getRequest()->get('title', 'anonymous');
        $oEvent = $this->getEventManager()->getEventById($id);

        $participate = $this->getRequest()->get('participate') ?
            EventMemberModel::PARTICIPATE_YES : EventMemberModel::PARTICIPATE_NO;

        if ($this->getSecurityContext()->isGranted('ROLE_USER')) {
            $oUser = $this->getSecurityContext()->getToken()->getUser();
            $this->getEventMemberManager()->participateUserFriend($oEvent, $oUser, $title, $participate);
        } else {
            $this->getEventMemberManager()->participateAnonymous($oEvent, $title, $participate);
        }

        return new RedirectResponse($this->generateUrl('football_event_index', ['id' => $id]));
    }
}