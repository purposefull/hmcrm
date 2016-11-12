<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
use AppBundle\Form\LeadType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MailerLiteApi\MailerLite;

/**
 * Lead controller.
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
     * @Route("/", name="lead_create")
     * @Method("POST")
     * @Template("AppBundle:Lead:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Lead();

        $form = $this->createForm(LeadType::class, $entity, [
            'action' => $this->generateUrl('lead_create'),
            'method' => 'POST',
        ]);

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
     * @Route("/new", name="lead_new")
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
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/lead_capture_form", name="lead_capture_form")
     * @Template()
     */
    public function leadCaptureFormAction(Request $request)
    {
        if ($request->getMethod() == 'POST' || $request->getMethod() == 'GET') {
            // $form = $request->request->all();

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

//                // MailerLite adding subscriber
                $mailerLite = new \MailerLiteApi\MailerLite('d4d847245983c24a7400a97546d12b40');
                $groupsApi = $mailerLite->groups();

                $subscriber = [
                    'email' => $request->get('email'),
                    'fields' => [
                        'name' => $request->get('name'),
                    ],
                ];

                // Fixed hardcode GROUP_ID
                if ($request->get('event') == 'healthmarketing') {
                    $groupsApi->addSubscriber('4336713', $subscriber);
                } else {
                    $groupsApi->addSubscriber('4284365', $subscriber);
                }

                if ($request->get('redirectUrl')) {
                    //                    $variables = [
//                        'order_id' => $lead->getId(),
//                        'name' => $request->get('name'),
////                        'surname' => $request->get('surname'),
//                        'email' => $request->get('surname'),
//                        'phone' => $request->get('phone1').$request->get('phone1').$request->get('phone2'),
//                        'city' => $request->get('city'),
//                        'country' => $request->get('country'),
//                        'amount' => $request->get('amount')
//                    ];
                    return new RedirectResponse($request->get('redirectUrl'));
//                    header('Location: '.$request->get('redirectUrl').'?'.http_build_query($variables));
//                    exit;
                    /*return new RedirectResponse('/lead/test', 302, [
                        'order_id' => $lead->getId(),
                        'name' => $request->get('name'),
                        'surname' => $request->get('surname'),
                    ]);*/
                } else {
                    return new JsonResponse(true);
                }
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
     * @ParamConverter("lead", class="AppBundle:Lead")
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
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/edit/{id}", name="lead_edit")
     *
     * @Template()
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lead = $em->getRepository(Lead::class)->find($request->get('id'));

        if ($this->getUser() !== $lead->getUser()) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $editForm = $this->createForm(LeadType::class,
            $lead,
            [
                'action' => $this->generateUrl('lead_edit', [
                    'id' => $lead->getId(),
                ]),
            ]);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $lead = $editForm->getData();
            $em->persist($lead);
            $em->flush();
        }

        return [
            'entity' => $lead,
            'edit_form' => $editForm->createView()
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
                    ->add('submit', SubmitType::class, [
                        'label' => 'Delete',
                    ])
                    ->getForm();
    }
}
