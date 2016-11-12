<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Template;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Lead;
use AppBundle\Form\TemplateType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MailerLiteApi\MailerLite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as TemplateAnnotation;

class TemplateController extends Controller
{
    /**
     * Lists all Template entities.
     *
     * @return Response
     *
     * @Route("/email_template", name="email_template")
     * @Method("GET")
     * @TemplateAnnotation()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Template')->findByUser($this->getUser());

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Template entity.
     *
     * @param Request $request Request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/email_template/create", name="template_create")
     * @Method("POST")
     * @TemplateAnnotation("AppBundle:Template:new.html.twig")
     */
    public function createAction(Request $request)
    {

        $entity = new Template();
        $form = $this->createForm(TemplateType::class,
            $entity,
            [
              'action' => $this->generateUrl('template_create'),
              'method' => 'POST',
            ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('template_show', [
                'id' => $entity->getId(),
            ]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Displays a form to create a new Template entity.
     *
     * @return Response
     *
     * @Route("/email_template/new", name="template_new")
     * @Method("GET")
     * @TemplateAnnotation()
     */
    public function newAction()
    {
        $entity = new Template();

        $form = $this->createForm(
            TemplateType::class,
            $entity,
            [
                'action' => $this->generateUrl('template_create'),
                'method' => 'POST',
            ]
        );

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Template entity.
     *
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/email_template/show/{id}", name="template_show")
     * @Method("GET")
     * @TemplateAnnotation()
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $template = $em->getRepository(Template::class)->find($request->get('id'));

        if ($this->getUser() !== $template->getUser()) {
            throw $this->createNotFoundException('Unable to find Template entity.');
        }

        return [
            'entity' => $template
        ];
    }

    /**
     * Edits an existing Template entity.
     *
     * @param Request $request Request
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/email_template/edit/{id}", name="template_edit")
     *
     * @TemplateAnnotation("AppBundle:Template:edit.html.twig")
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $template = $em->getRepository(Template::class)->find($request->get('id'));

        if ($this->getUser() !== $template->getUser()) {
            throw $this->createNotFoundException('Unable to find Template entity.');
        }

        $editForm = $this->createForm(TemplateType::class, $template, [
        'action' => $this->generateUrl('template_edit', [
            'id' => $template->getId(),
        ]),
    ]);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $template = $editForm->getData();
            $em->persist($template);
            $em->flush();
        }

        return [
            'entity' => $template,
            'edit_form' => $editForm->createView()
        ];
    }

    /**
     * Deletes a Template entity.
     *
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/email_template/delete/{id}", name="template_delete")
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $template = $em->getRepository(Template::class)->find($request->get('id'));

        if ($this->getUser() !== $template->getUser()) {
            throw $this->createNotFoundException('Unable to find Template entity.');
        }

        $em->remove($template);
        $em->flush();

        return $this->redirect($this->generateUrl('email_template'));
    }
}
