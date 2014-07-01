<?php

namespace Ps\SlavsBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="slavs_index")
     * @Secure(roles="ROLE_SLAVS")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'slavs' => $this->get('doctrine')->getRepository('PsSlavsBundle:Slavs')->findAllOrdered('goals', 'DESC')
        ];
    }
}
