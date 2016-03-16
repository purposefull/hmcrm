<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasymedBundle\Entity\Lead;
use EasymedBundle\Form\LeadType;

/**
 * Lead controller.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/lead")
 */
class LeadController extends Controller
{
    /**
     * Lists all Lead entities.
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
     * @Route("/", name="lead_create")
     * @Method("POST")
     * @Template("EasymedBundle:Lead:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Lead();
        $form   = $this->createCreateForm($entity);
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
            'form'   => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Lead entity.
     *
     * @param Lead $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
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
     * @Route("/new", name="lead_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lead();
        $form   = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * @Route("/lead_capture_form", name="lead_capture_form")
     * @Template()
     */
    public function leadCaptureFormAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $form = $request->request->all();
            if (!empty($form['userId']) && !empty($form['name']) && !empty($form['email'])) {
                $lead = new Lead();
                $lead->setLastName($form['name']);
                $lead->setEmail($form['email']);

                if (isset($form['phone']) && $form['phone']) {
                    $lead->setMobilePhone($form['phone']);
                }

                if (isset($form['product']) && $form['product']) {
                    $lead->setProduct($form['product']);
                }

                $user = $this->getDoctrine()->getRepository('ApplicationSonataUserBundle:User')->find($form['userId']);
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
     * @Route("/lead_capture_form_settings", name="lead_capture_form_settings")
     * @Template()
     */
    public function leadCaptureFormSettingsAction(Request $request)
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
     * @Route("/show/{id}", name="lead_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->findOneBy([
            'id'   => $id,
            'user' => $this->getUser(),
        ]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Lead entity.
     *
     * @Route("/edit/{id}", name="lead_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->findOneBy([
            'id'   => $id,
            'user' => $this->getUser(),
        ]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $editForm   = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Lead entity.
     *
     * @param Lead $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
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
     * @Route("/update/{id}", name="lead_update")
     * @Method("PUT")
     * @Template("EasymedBundle:Lead:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->findOneBy([
            'id'   => $id,
            'user' => $this->getUser(),
        ]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lead_show', [
                'id' => $id,
            ]));
        }

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Lead entity.
     *
     * @Route("/delete/{id}", name="lead_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em     = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EasymedBundle:Lead')->findOneBy([
            'id'   => $id,
            'user' => $this->getUser(),
        ]);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $em->remove($entity);
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
