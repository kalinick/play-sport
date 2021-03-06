<?php
/**
 * User: nikk
 * Date: 6/4/13
 * Time: 4:22 PM
 */

namespace Ps\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/", name="front_index")
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('football_index'));
    }
}