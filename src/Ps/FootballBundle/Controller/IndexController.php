<?php
/**
 * User: nikk
 * Date: 6/4/13
 * Time: 5:11 PM
 */

namespace Ps\FootballBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Ps\FrontBundle\Controller\AbstractEventsController;
use Ps\AppBundle\Model\SportModel;

class IndexController extends AbstractEventsController
{
    /**
     * @Route("/", name="football_index")
     */
    public function indexAction()
    {
        return self::show(SportModel::FOOTBALL);
    }
}