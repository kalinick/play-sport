<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:12 PM
 */

namespace Ps\FootballBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Ps\AppBundle\Controller\GetContainerTrait;
use Ps\AppBundle\Classes\CookiesAnonymousEventMember;
use Ps\AppBundle\Model\EventMemberModel;
use Ps\AppBundle\Exception\EventMemberException;
use Ps\AppBundle\Entity;


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

        $aResult = [
            'event' => $oEvent,
        ];

        if ( $this->getSecurityContext()->isGranted('ROLE_USER') ) {
            $oUser = $this->getSecurityContext()->getToken()->getUser();
            $oParticipation = $this->getEventMemberManager()->getUserParticipation($oEvent, $oUser);
            $aResult['participate'] = ($oParticipation === null) ? null : $oParticipation->getTitle();
            $aResult['friends'] = '"' . implode('", "', $this->getUserFriendManager()->getUserFriends($oUser)) . '"';
        } else {
            $anonymousId = (new CookiesAnonymousEventMember($id))->get($this->getRequest()->cookies);
            if ( !empty($anonymousId) ) {
                $aResult['anonymous'] = $this->getEventMemberManager()->getAnonymousMemberById($anonymousId);
            }
        }

        $participateMetric = ['yes' => 0, 'no' => 0, 'wish' => 0];
        foreach($oEvent->getEventMembers() as $member) {
            $participateMetric[$member->getParticipation()->getTitle()]++;
        }

        $aResult['participateMetric'] = $participateMetric;

        return $aResult;
    }

    /**
     * @Route("/event/{id}/participate", name="football_event_participate")
     * @Method({"POST"})
     */
    public function participateAction($id)
    {
        $oEvent = $this->getEventManager()->getEventById($id);
        $oUser = $this->getSecurityContext()->getToken()->getUser();
        $sTitle = $this->getRequest()->get('title');
        $eType = $this->getRequest()->get('type');
        $eParticipate = $this->getRequest()->get('participate') ?
            EventMemberModel::PARTICIPATE_YES : EventMemberModel::PARTICIPATE_NO;

        $oResponse = new RedirectResponse($this->generateUrl('football_event_index', ['id' => $id]));
        try{
            switch($eType) {
                case 'user':
                    $this->getEventMemberManager()->participateUser($oEvent, $eParticipate, $oUser);
                    break;
                case 'userFriend':
                    $this->getEventMemberManager()->participateUserFriend($oEvent, $eParticipate, $oUser, $sTitle);
                    break;
                case 'anonymous':
                    $anonymousId = (new CookiesAnonymousEventMember($id))->get($this->getRequest()->cookies);
                    $oAnonymousEM = $this->getEventMemberManager()->
                        participateAnonymous($oEvent, $eParticipate, $anonymousId, $sTitle);
                    $cookieAnonymousEM = new CookiesAnonymousEventMember($id);
                    $oResponse->headers->setCookie($cookieAnonymousEM->createCookies($oAnonymousEM->getId()));
                    break;
                default:
                    throw new BadRequestHttpException('Participate type should be defined');
                    break;
            }
        } catch (EventMemberException $ex) {
            $this->getSession()->getFlashBag()->add('error', $ex->getMessage());
        }
        return $oResponse;
    }
}