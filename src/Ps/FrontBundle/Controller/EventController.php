<?php
/**
 * User: nikk
 * Date: 8/21/13
 * Time: 4:47 PM
 */

namespace Ps\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/event")
 */
class EventController extends AbstractEventController
{
    /**
     * @Route("/{id}/load-members", name="event_load_members")
     */
    public function loadMembersAction($id)
    {
        $oEvent = $this->getEventManager()->getEventById($id);

        $aResult = ['event' => $oEvent];
        $aResult['participateMetric'] = $this->getEventMemberManager()->countEventParticipation($oEvent);

        return $this->render('PsFrontBundle:AbstractEvent:members.html.twig', $aResult);
    }
}