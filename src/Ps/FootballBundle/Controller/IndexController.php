<?php
/**
 * User: nikk
 * Date: 6/4/13
 * Time: 5:11 PM
 */

namespace Ps\FootballBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ps\AppBundle\Controller\GetContainerTrait;

class IndexController extends Controller
{
    use GetContainerTrait;

    /**
     * @Route("/", name="football_index")
     * @Template()
     */
    public function indexAction()
    {
        return ['events' => $this->getEventManager()->getActualEvents()];
    }
}