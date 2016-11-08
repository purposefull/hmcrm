<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReportController extends Controller
{
    /**
     * @Route("/report", name="report")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        // leads by months
        $stmt = $connection->prepare(
'SELECT COUNT(lead.id) AS leadcount 
FROM lead 
GROUP BY EXTRACT(MONTH FROM created_at) 
ORDER BY EXTRACT(MONTH FROM created_at);');
        $stmt->execute();
        $leads = $stmt->fetchAll();

        // deals by months
        $stmt = $connection->prepare(
'SELECT COUNT(deal.id) AS dealcount 
FROM deal 
GROUP BY EXTRACT(MONTH FROM created_at) 
ORDER BY EXTRACT(MONTH FROM created_at);'
        );
        $stmt->execute();
        $deals = $stmt->fetchAll();

        $leadcount = array_column($leads, 'leadcount');
        $dealcount = array_column($deals, 'dealcount');

        return [
            'leads' => $leadcount,
            'deals' => $dealcount,
        ];
    }

    /**
     * Task action.
     *
     * @return RedirectResponse
     *
     * @Route("/task", name="task")
     * @Template()
     */
    public function taskAction()
    {
        return [];
    }

    /**
     * Task action.
     *
     * @return RedirectResponse
     *
     * @Route("/calendar", name="calendar")
     * @Template()
     */
    public function calendarAction()
    {
        return [];
    }
}
