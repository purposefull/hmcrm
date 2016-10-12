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

        $connection = $em->getConnection();

        $stmt = $connection->prepare('SELECT COUNT(lead.id) AS leadcount FROM lead GROUP BY EXTRACT(MONTH FROM created_at) ORDER BY EXTRACT(MONTH FROM created_at);');
        $stmt->execute();

        $results = $stmt->fetchAll();

        $leadcount = array_column($results, 'leadcount');

//['January' => 10, 'February' => 20]
        return [
            'results' => $leadcount,
            'leads' => $leads,
            'deals' => $deals,
            'average_deal' => [],
        ];
    }
}
