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

use Ps\AppBundle\Entity\EventMember;
use Ps\AppBundle\Controller\GetContainerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventController extends Controller
{
    use GetContainerTrait;

    /**
     * @Route("/event/{id}", name="football_event_index")
     * @Template()
     */
    public function indexAction($id)
    {
        $event = $this->getEventManager()->getEventById($id);

        $user = [];
        $user['authorized'] = $this->getSecurityContext()->isGranted('ROLE_USER');
        if ($this->getSecurityContext()->isGranted('ROLE_USER')) {
            $oUser = $this->getSecurityContext()->getToken()->getUser();
            $user['subscribed'] = $this->getEventMemberManager()->isUserParticipate($event, $oUser);
        }

        return [
            'event' => $event,
            'user' => $user,
        ];
    }

    /**
     * @Route("/event/{id}/participate-user", name="football_event_participate_user")
     * @Method({"POST"})
     * @Template()
     */
    public function participateUserAction($id)
    {
        $event = $this->getEventManager()->getEventById($id);
        $user = $this->getSecurityContext()->getToken()->getUser();

        $this->getEventMemberManager()->participateUser($event, $user, $this->getRequest()->get('participate'));
        return new JsonResponse([]);
    }
}