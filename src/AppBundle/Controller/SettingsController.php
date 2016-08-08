<?php

namespace AppBundle\Controller;

use AppBundle\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * SettingsController class.
 *
 */
class SettingsController extends Controller
{
    /**
     * Returns list of integration services.
     *
     * @return Response
     *
     * @Route("/settings", name="settings")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->createForm(SettingsType::class, $this->getUser());

        if ($form->isValid()) {
            var_dump(123);exit;
        } else {
//            var_dump($form->getErrors());
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Returns list of integration services.
     *
     * @return Response
     *
     * @Route("/email", name="email")
     * @Template()
     */
    public function emailAction()
    {
        return [
            'state' => md5(str_shuffle('abcdefghijklmnopqr')),
        ];
    }
}
