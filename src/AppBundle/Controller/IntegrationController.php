<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * IntegrationController class.
 *
 * @Route("integration")
 */
class IntegrationController extends Controller
{
    /**
     * Returns list of integration services.
     *
     * @return Response
     *
     * @Route("/", name="tasks")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'state' => md5(str_shuffle('abcdefghijklmnopqr')),
        ];
    }

    /**
     * Returns list of integration services.
     *
     * @return Response
     *
     * @Route("/", name="email")
     * @Template()
     */
    public function emailAction()
    {
        return [
            'state' => md5(str_shuffle('abcdefghijklmnopqr')),
        ];
    }
}
