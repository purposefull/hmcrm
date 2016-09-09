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
        //        $exporter = $this->get('ee.dataexporter');
//        $testObject = new TestObject();

//        $exporter->setOptions('xls', array('fileName' => 'file'));
//        $exporter->setColumns(array('col1' => 'Label1', 'col2' => 'Label2', 'col3.col1' => 'From object two'));
//        $exporter->setData(array($testObject));

//        return $exporter->render();

        return [];
    }
}
