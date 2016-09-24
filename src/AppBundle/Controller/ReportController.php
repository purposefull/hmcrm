<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ReportController extends Controller
{
    /**
     * @Route("/report", name="report")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $leads = $em->getRepository('AppBundle:Lead')->findAll();
        $deals = $em->getRepository('AppBundle:Deal')->findAll();

        return [
            'leads' => $leads,
            'deals' => $deals,
            'average_deal' => [],
        ];
    }
}
