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

use Ps\AppBundle\Entity\Event;
use Ps\AppBundle\Entity\EventMember;

class EventController extends Controller
{
    /**
     * @Route("/event/{id}", name="football_event_index")
     * @Template()
     */
    public function indexAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $repository = $this->getDoctrine()->getRepository('PsAppBundle:Event');
        /* @var Event $event*/
        $event = $repository->find($id);

        $this->id = $user->getId();
        $bool = $event->getEventMembers()->exists(function($n, EventMember $eventMember){
            return $eventMember->getUser()->getId() == $this->id;
        });

        return [];
    }
}