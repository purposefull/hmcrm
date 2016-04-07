<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use EasymedBundle\Entity\Lead;
use EasymedBundle\Form\LeadType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Lead controller.
 *
 *
 * @Route("/lead")
 */
class LeadController extends Controller
{
    /**
     * Lists all Lead entities.
     *
     * @return Response
     *
     * @Route("/", name="lead")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EasymedBundle:Lead')->findByUser($this->getUser());

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Lead entity.
     *
     * @param Request $request Request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/", name="lead_create")
     * @Method("POST")
     * @Template("EasymedBundle:Lead:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Lead();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lead_show', [
                'id' => $entity->getId(),
            ]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Lead entity.
     *
     * @param Lead $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Lead $entity)
    {
        $form = $this->createForm(new LeadType(), $entity, [
            'action' => $this->generateUrl('lead_create'),
            'method' => 'POST',
        ]);

        return $form;
    }

    /**
     * Displays a form to create a new Lead entity.
     *
     * @return Response
     *
     * @Route("/new", name="lead_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lead();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/lead_capture_form", name="lead_capture_form")
     * @Template()
     */
    public function leadCaptureFormAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $form = $request->request->all();

            $lead = new Lead();
            if ($request->get('userId')) {

                $lead->setLastName($request->get('name', 'healthyfood'));
                $lead->setEmail($request->get('email', 'info@healthmarketing.me'));

                if ($request->get('phone')) {
                    $lead->setMobilePhone($request->get('phone'));
                }

                if (isset($form['product']) && $request->get('product')) {
                    $lead->setProduct($request->get('product'));
                }

                $user = $this->getDoctrine()
                    ->getRepository('ApplicationSonataUserBundle:User')
                    ->find($request->get('userId'));

                if ($user) {
                    $lead->setUser($user);
                } else {
                    throw new EntityNotFoundException();
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($lead);
                $em->flush();

                return $this->redirect($request->get('redirectUrl'));
            }
        }
    }

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/lead_capture_form/{phone}", name="lead_capture_form_phone")
     * @Template()
     */
    public function leadCaptureFormPhoneAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $form = $request->request->all();

            $lead = new Lead();
            if ($request->get('phone')) {

                $lead->setLastName($request->get('name', 'healthyfood'));
                $lead->setEmail($request->get('email', 'info@healthmarketing.me'));
                $lead->setMobilePhone($request->get('phone'));

                $user = $this->getDoctrine()
                    ->getRepository('ApplicationSonataUserBundle:User')
                    ->find(7);

                if ($user) {
                    $lead->setUser($user);
                } else {
                    throw new EntityNotFoundException();
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($lead);
                $em->flush();

                return new JsonResponse(true);
            }
        }
    }

    /**
     * @return RedirectResponse|Response
     *
     * @Route("/lead_capture_form_settings", name="lead_capture_form_settings")
     * @Template()
     */
    public function leadCaptureFormSettingsAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return [];
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

    /**
     * Finds and displays a Lead entity.
     *
     * @param Lead $lead Lead
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/show/{id}", name="lead_show")
     * @Method("GET")
     * @ParamConverter("lead", class="EasymedBundle:Lead")
     * @Template()
     */
    public function showAction(Lead $lead)
    {
        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $deleteForm = $this->createDeleteForm($lead->getId());

        return [
            'entity' => $lead,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Lead entity.
     *
     * @param Lead $lead Lead
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/edit/{id}", name="lead_edit")
     * @Method("GET")
     * @ParamConverter("lead", class="EasymedBundle:Lead")
     * @Template()
     */
    public function editAction(Lead $lead)
    {
        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $editForm = $this->createEditForm($lead);
        $deleteForm = $this->createDeleteForm($lead->getId());

        return [
            'entity' => $lead,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Lead entity.
     *
     * @param Lead $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Lead $entity)
    {
        $form = $this->createForm(new LeadType(), $entity, [
            'action' => $this->generateUrl('lead_update', [
                'id' => $entity->getId(),
            ]),
            'method' => 'PUT',
        ]);

        $form->add('submit', 'submit', [
            'label' => 'Update',
        ]);

        return $form;
    }

    /**
     * Edits an existing Lead entity.
     *
     * @param Request $request Request
     * @param Lead    $lead    Lead
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/update/{id}", name="lead_update")
     * @Method("PUT")
     * @ParamConverter("lead", class="EasymedBundle:Lead")
     * @Template("EasymedBundle:Lead:edit.html.twig")
     */
    public function updateAction(Request $request, Lead $lead)
    {
        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($lead->getId());
        $editForm = $this->createEditForm($lead);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lead_show', [
                'id' => $lead->getId(),
            ]));
        }

        return [
            'entity' => $lead->getId(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Lead entity.
     *
     * @param Lead $lead Lead
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="lead_delete")
     * @ParamConverter("lead", class="EasymedBundle:Lead")
     */
    public function deleteAction(Lead $lead)
    {
        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($lead);
        $em->flush();

        return $this->redirect($this->generateUrl('lead'));
    }

    /**
     * Creates a form to delete a Lead entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('lead_delete', [
                        'id' => $id,
                    ]))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', [
                        'label' => 'Delete',
                    ])
                    ->getForm();
    }
}
