<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Company;
use AppBundle\Form\CompanyType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @return Response
     *
     * @Route("/", name="company")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $entities = $em->getRepository('AppBundle:Company')->findByUser($user);

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Company entity.
     *
     * @return RedirectResponse|Response
     *
     * @Route("/", name="company_create")
     * @Method("POST")
     * @Template("AppBundle:Company:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Company();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact = new Contact();
            $contact->setType(Contact::TYPE_COMPANY);
            $contact->setUser($this->getUser());
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $contact->setCompany($entity);
            $em->persist($contact);

            $em->flush();

            return $this->redirect($this->generateUrl('company_show', [
                'id' => $entity->getId(),
            ]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Company entity.
     *
     * @param Company $entity The entity
     *
     * @return Form
     * @return Form The form
     */
    private function createCreateForm(Company $entity)
    {
        $form = $this->createForm(new CompanyType(), $entity, [
            'action' => $this->generateUrl('company_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [
            'label' => 'Create',
        ]);

        return $form;
    }

    /**
     * Displays a form to create a new Company entity.
     *
     * @return Response
     *
     * @Route("/new", name="company_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Company();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Company entity.
     *
     * @param Company $company Company
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}", name="company_show")
     * @Method("GET")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template()
     */
    public function showAction(Company $company)
    {
        $deleteForm = $this->createDeleteForm($company->getId());

        if ($this->getUser() !== $company->getUser()) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        return [
            'entity' => $company,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Company entity.
     *
     * @param Company $company Company
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}/edit", name="company_edit")
     * @Method("GET")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template()
     */
    public function editAction(Company $company)
    {
        $editForm = $this->createEditForm($company);
        $deleteForm = $this->createDeleteForm($company->getId());

        if ($this->getUser() !== $company->getUser()) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        return [
            'entity' => $company,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
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
        $form = $this->createForm(new CompanyType(), $entity, [
            'action' => $this->generateUrl('company_update', [
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
     * Edits an existing Company entity.
     *
     * @param Request $request Request
     * @param Company $company Company
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/{id}", name="company_update")
     * @Method("PUT")
     * @ParamConverter("deal", class="AppBundle:Deal")
     * @Template("AppBundle:Company:edit.html.twig")
     */
    public function updateAction(Request $request, Company $company)
    {
        $em = $this->getDoctrine()->getManager();

        if ($this->getUser() !== $company->getUser()) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $deleteForm = $this->createDeleteForm($company->getId());
        $editForm = $this->createEditForm($company);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('company_show', [
                'id' => $company->getId(),
            ]));
        }

        return [
            'entity' => $company,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Company entity.
     *
     * @param Request $request Request
     * @param Company $company Company
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/{id}", name="company_delete")
     * @Method("DELETE")
     * @ParamConverter("company", class="AppBundle:Company")
     */
    public function deleteAction(Request $request, Company $company)
    {
        if ($this->getUser() !== $company->getUser()) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $form = $this->createDeleteForm($company->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('company'));
    }

    /**
     * Creates a form to delete a Company entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('company_delete', [
                        'id' => $id,
                    ]))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', [
                        'label' => 'Delete',
                    ])
                    ->getForm();
    }
}
