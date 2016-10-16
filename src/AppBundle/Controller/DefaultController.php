<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lead;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('lp'));
        }

        return [];
    }

    /**
     * @Route("/lp", name="lp")
     * @Template()
     */
    public function lpAction(Request $request)
    {
        return [];
    }

    /**
     * Import action.
     *
     * @return RedirectResponse
     *
     * @Route("/import", name="import")
     * @Template()
     */
    public function importAction()
    {
        return [];
    }

    /**
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export", name="export")
     * @Template()
     */
    public function exportAction()
    {
        //        $exporter = $this->get('fungio.dataexporter');
//        $Lead = new Lead();

//        $exporter->setOptions('json', array('fileName' => 'file', 'separator' => ';'));
//        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
//        $exporter->setData(array($Lead));

//        return $exporter->render();

        return [];
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
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export_json", name="json")
     */
    public function exportJSONAction()
    {
        $exporter = $this->get('fungio.dataexporter');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $leads = $em->getRepository('AppBundle:Lead')->findByUser($user);

        $lead0 = [];

        foreach ($leads as $lead) {

            $lead0[] = $lead;
        }

        $exporter->setOptions('json', array('fileName' => 'file'));
        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
        $exporter->setData($lead0);

        return $exporter->render();
    }

    /**
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export_html", name="html")
     */
    public function exportHTMLAction()
    {
        $exporter = $this->get('fungio.dataexporter');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $leads = $em->getRepository('AppBundle:Lead')->findByUser($user);

        $lead1 = [];

        foreach ($leads as $lead) {
            $lead1[] = $lead;
        }

        $exporter->setOptions('html', array('fileName' => 'file'));
        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
        $exporter->setData($lead1);

        return $exporter->render();
    }

    /**
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export_csv", name="csv")
     */
    public function exportCSVAction()
    {
        $exporter = $this->get('fungio.dataexporter');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $leads = $em->getRepository('AppBundle:Lead')->findByUser($user);

        $lead2 = [];

        foreach ($leads as $lead) {
            $lead2[] = $lead;
        }

        $exporter->setOptions('csv', array('fileName' => 'file'));
        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
        $exporter->setData($lead2);

        return $exporter->render();
    }

    /**
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export_xml", name="xml")
     */
    public function exportXMLAction()
    {
        $exporter = $this->get('fungio.dataexporter');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $leads = $em->getRepository('AppBundle:Lead')->findByUser($user);

        $lead3 = array();

        foreach ($leads as $lead) {

            $lead3[] = $lead;
        }

        $exporter->setOptions('xml', array('fileName' => 'file'));
        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
        $exporter->setData($lead3);

        return $exporter->render();
    }

    /**
     * Export action.
     *
     * @return RedirectResponse
     *
     * @Route("/export_xls", name="xls")
     */
    public function exportXLSAction()
    {
        $exporter = $this->get('fungio.dataexporter');

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $leads = $em->getRepository('AppBundle:Lead')->findByUser($user);

        foreach ($leads as $lead) {

            $lead4[] = $lead;
        }

        $exporter->setOptions('xls', array('fileName' => 'file', 'separator' => ';'));
        $exporter->setColumns(array('firstName' => 'firstName', 'mobilePhone' => 'mobilePhone', 'country' => 'country'));
        $exporter->setData($lead4);

        return $exporter->render();
    }

    /**
     * @return RedirectResponse
     *
     * @Route("/export_pdf", name="pdf")
     */
    public function exportPDFAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $entities = $em->getRepository('AppBundle:Lead')->findByUser($user);

        $html = $this->renderView('AppBundle:Default:pdf.html.twig', ['entities' => $entities]);

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                 'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
}
