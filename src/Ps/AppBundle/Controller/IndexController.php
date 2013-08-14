<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 1:18 PM
 */

namespace Ps\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $locale = $this->getRequest()->getLocale();
        return $this->redirect($this->generateUrl('front_index', ['_locale' => $locale]));
    }
}