<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:12 PM
 */

namespace Ps\FootballBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Ps\FrontBundle\Controller\AbstractEventController;

class EventController extends AbstractEventController
{
    /**
     * @Route("/event/{id}", name="football_event_index")
     */
    public function indexAction($id)
    {
        return parent::show($id);
    }

    /**
     * @Route("/event/{id}/participate", name="football_event_participate")
     * @Method({"POST"})
     */
    public function participateAction($id)
    {
        return parent::participate($id, 'football_event_index');
    }
}