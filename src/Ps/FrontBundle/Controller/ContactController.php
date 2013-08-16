<?php 
namespace Ps\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContactController extends Controller
{
    /**
     * @Route("/contactUs", name="front_contact")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }
}
