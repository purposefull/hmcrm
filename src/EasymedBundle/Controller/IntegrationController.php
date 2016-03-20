<?php

namespace EasymedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * IntegrationController class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
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
     * @Route("/", name="integration_index")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'state' => md5(str_shuffle('abcdefghijklmnopqr')),
        ];
    }
}
