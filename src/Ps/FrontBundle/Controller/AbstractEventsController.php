<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 3:40 PM
 */

namespace Ps\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response;

use Ps\AppBundle\Controller\GetContainerTrait;

abstract class AbstractEventsController extends Controller
{
    use GetContainerTrait;

    /**
     * @param string $sport
     * @return array
     */
    public function show($sport)
    {
        $aResult = ['events' => $this->getEventManager()->getActualEvents($sport)];
        return $aResult;
    }
}