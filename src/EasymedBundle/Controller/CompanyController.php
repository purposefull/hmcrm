<?php

namespace EasymedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasymedBundle\Entity\Company;
use EasymedBundle\Form\CompanyType;

/**
 * Company controller.
 *
 * @Route("/company")
 */
class CompanyController extends Controller
{

    /**
     * Lists all Company entities.
     *
     * @Route("/", name="company")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $entities = $em->getRepository('EasymedBundle:Company')->findByUser($user);

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Company entity.
     *
     * @Route("/", name="company_create")
     * @Method("POST")
     * @Template("EasymedBundle:Company:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $entity = new Company();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('company_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Company entity.
     *
     * @param Company $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Company $entity)
    {
        $form = $this->createForm(new CompanyType(), $entity, array(
            'action' => $this->generateUrl('company_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Company entity.
     *
     * @Route("/new", name="company_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $entity = new Company();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Company entity.
     *
     * @Route("/{id}", name="company_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Company')->findOneBy(array(
            'id' => $id,
            'user' => $this->getUser()
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Company entity.
     *
     * @Route("/{id}/edit", name="company_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Company')->findOneBy(array(
            'id' => $id,
            'user' => $this->getUser()
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
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
    * Creates a form to edit a Company entity.
    *
    * @param Company $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Company $entity)
    {
        $form = $this->createForm(new CompanyType(), $entity, array(
            'action' => $this->generateUrl('company_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Company entity.
     *
     * @Route("/{id}", name="company_update")
     * @Method("PUT")
     * @Template("EasymedBundle:Company:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EasymedBundle:Company')->findOneBy(array(
            'id' => $id,
            'user' => $this->getUser()
        ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('company_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Company entity.
     *
     * @Route("/{id}", name="company_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EasymedBundle:Company')->findOneBy(array(
                'id' => $id,
                'user' => $this->getUser()
            ));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Company entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('company'));
    }

    /**
     * Creates a form to delete a Company entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('company_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
