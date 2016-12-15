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
'SELECT COUNT(lead.id) AS leads, EXTRACT(MONTH FROM created_at) AS month
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

        $leadcount = $this->fixMonths($leads);
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

    /**
     * @param array $monthCollection
     *
     * @return array
     */
    public function fixMonths(array $monthCollection)
    {
        // create array with month keys
        $result_array = [];
        foreach ($monthCollection as $el) {
            $result_array[$el['month']] = $el['leads'];
        }

        // added unused months with 0
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($result_array[$i])) {
                $result_array[$i] = 0;
            }
        }

        ksort($result_array);

        return $result_array;
    }
}
