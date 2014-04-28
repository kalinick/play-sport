<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 3:16 PM
 */

namespace Ps\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Ps\AppBundle\Controller\GetContainerTrait;
use Ps\AppBundle\Classes\CookiesAnonymousEventMember;
use Ps\AppBundle\Model\EventMemberModel;
use Ps\AppBundle\Exception\EventMemberException;

abstract class AbstractEventController extends Controller
{
    use GetContainerTrait;

    /**
     * @param int $id - event id
     * @return array
     */
    public function show($id)
    {
        $oEvent = $this->getEventManager()->getEventById($id);

        $aResult = [
            'event' => $oEvent,
            'id' => $id,
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

        $aResult['participateMetric'] = $this->getEventMemberManager()->countEventParticipation($oEvent);

        return $aResult;
    }

    /**
     * @param int $id - event id
     * @param string $eventRoute - route  of event action. Where browser will return after participate action
     * @return RedirectResponse
     * @throws BadRequestHttpException
     */
    public function participate($id, $eventRoute)
    {
        $oEvent = $this->getEventManager()->getEventById($id);
        $oUser = $this->getSecurityContext()->getToken()->getUser();
        $sTitle = $this->getRequest()->get('title');
        $eType = $this->getRequest()->get('type');
        $eParticipate = $this->getRequest()->get('participate') ?
            EventMemberModel::PARTICIPATE_YES : EventMemberModel::PARTICIPATE_NO;

        $oResponse = new RedirectResponse($this->generateUrl($eventRoute, ['id' => $id]));
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