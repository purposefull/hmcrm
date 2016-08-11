<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('lp'));
        }

        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/lp", name="lp")
     */
    public function lpAction(Request $request)
    {
        return $this->render('lp.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/lp/ru", name="lp_ru")
     */
    public function lpRuAction(Request $request)
    {
        return $this->render('lp_ru.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
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
        //        $exporter = $this->get('ee.dataexporter');
//        $testObject = new TestObject();
//
//        $exporter->setOptions('xls', array('fileName' => 'file'));
//        $exporter->setColumns(array('col1' => 'Label1', 'col2' => 'Label2', 'col3.col1' => 'From object two'));
//        $exporter->setData(array($testObject));
//
//        return $exporter->render();

        return [];
    }
}
