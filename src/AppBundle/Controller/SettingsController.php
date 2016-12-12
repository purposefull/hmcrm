<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * SettingsController class.
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
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SettingsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
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
