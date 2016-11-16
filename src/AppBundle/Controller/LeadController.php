<?php

namespace AppBundle\Controller;

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
use AppBundle\Entity\Lead;
use AppBundle\Form\Type\LeadType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MailerLiteApi\MailerLite;

class LeadController extends Controller
{
    /**
     * Lists all Lead entities.
     *
     * @return Response
     *
     * @Route("/lead", name="lead")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Lead')->findByUser($this->getUser());

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
     * @Route("/lead", name="lead_create")
     * @Method("POST")
     * @Template("AppBundle:Lead:new.html.twig")
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
     * Displays a form to create a new Lead entity.
     *
     * @return Response
     *
     * @Route("/lead/new", name="lead_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lead();

        $form = $this->createForm(
            LeadType::class,
            $entity,
            [
                'action' => $this->generateUrl('lead_create'),
                'method' => 'POST',
            ]
        );

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
        $form = $this->createForm(LeadType::class, $entity, [
            'action' => $this->generateUrl('lead_create'),
            'method' => 'POST',
        ]);

        return $form;
    }

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/lead/lead_capture_form", name="lead_capture_form")
     * @Template()
     */
    public function leadCaptureFormAction(Request $request)
    {
        if ($request->getMethod() == 'POST' || $request->getMethod() == 'GET') {
            $lead = new Lead();

            if ($request->get('userId')) {
                $lead->setFirstName($request->get('name'));
                $lead->setEmail($request->get('email'));
                $lead->setEvent($request->get('event'));
                $lead->setMobilePhone($request->get('phone1').$request->get('phone2').$request->get('phone3'));

                $user = $this->getDoctrine()
                    ->getRepository('AppBundle:User')
                    ->find($request->get('userId'));

                if ($user) {
                    $lead->setUser($user);
                } else {
                    throw new EntityNotFoundException();
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($lead);
                $em->flush();

                // MailerLite adding subscriber
                $mailerLite = new MailerLite('d4d847245983c24a7400a97546d12b40');
                $groupsApi = $mailerLite->groups();

                $subscriber = [
                    'email' => $request->get('email'),
                    'fields' => [
                        'name' => $request->get('name'),
                    ],
                ];

                // TODO save GROUP_ID with database
                if ($request->get('event') == 'healthmarketing') {
                    $groupsApi->addSubscriber('4336713', $subscriber);
                } else {
                    $groupsApi->addSubscriber('4284365', $subscriber);
                }

                if ($request->get('redirectUrl')) {
                    return new RedirectResponse($request->get('redirectUrl'));
                } else {
                    return new JsonResponse(true);
                }
            }
        }
    }

    /**
     * @return RedirectResponse|Response
     *
     * @Route("/lead/lead_capture_form_settings", name="lead_capture_form_settings")
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
     * @Route("/lead/show/{id}", name="lead_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lead = $em->getRepository(Lead::class)->find($request->get('id'));

        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        return [
            'entity' => $lead,
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
     * @Route("/lead/edit/{id}", name="lead_edit")
     * @Method("GET")
     * @ParamConverter("lead", class="AppBundle:Lead")
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
        $form = $this->createForm(LeadType::class, $entity, [
            'action' => $this->generateUrl('lead_update', [
                'id' => $entity->getId(),
            ]),
            'method' => 'PUT',
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
     * @Route("/lead/update/{id}", name="lead_update")
     * @Method("PUT")
     * @ParamConverter("lead", class="AppBundle:Lead")
     * @Template("AppBundle:Lead:edit.html.twig")
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
     * @Route("/lead/delete/{id}", name="lead_delete")
     * @ParamConverter("lead", class="AppBundle:Lead")
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
                    ->getForm();
    }
}
