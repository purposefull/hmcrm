<?php

namespace EasymedBundle\Controller;

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

        $entities = $em->getRepository('EasymedBundle:Lead')->findAll();

        return array(
            'entities' => $entities,
        );
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
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lead_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
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
        $form = $this->createForm(new LeadType(), $entity, array(
            'action' => $this->generateUrl('lead_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

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

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Lead entity.
     *
     * @Route("/{id}", name="lead_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Lead entity.
     *
     * @Route("/{id}/edit", name="lead_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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
        $form = $this->createForm(new LeadType(), $entity, array(
            'action' => $this->generateUrl('lead_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Lead entity.
     *
     * @Route("/{id}", name="lead_update")
     * @Method("PUT")
     * @Template("EasymedBundle:Lead:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Lead')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lead entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lead_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Lead entity.
     *
     * @Route("/{id}", name="lead_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EasymedBundle:Lead')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lead entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

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
            ->setAction($this->generateUrl('lead_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
