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
use AppBundle\Entity\Person;
use AppBundle\Form\PersonType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Person controller.
 *
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * Lists all Person entities.
     *
     * @return Response
     *
     * @Route("/", name="person")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Person')->findByUser($this->getUser());

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Person entity.
     *
     * @param Request $request Request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/", name="person_create")
     * @Method("POST")
     * @Template("AppBundle:Person:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Person();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact = new Contact();
            $contact->setType(Contact::TYPE_PERSON);
            $contact->setUser($this->getUser());
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $contact->setPerson($entity);
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', [
                'id' => $entity->getId(),
            ]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Creates a form to create a Person entity.
     *
     * @param Person $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Person $entity)
    {
        $form = $this->createForm(new PersonType(), $entity, [
            'action' => $this->generateUrl('person_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', [
            'label' => 'Create',
        ]);

        return $form;
    }

    /**
     * Displays a form to create a new Person entity.
     *
     * @return Response
     *
     * @Route("/new", name="person_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Person();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Person entity.
     *
     * @param Person $person Person
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}", name="person_show")
     * @Method("GET")
     * @ParamConverter("person", class="AppBundle:Person")
     * @Template()
     */
    public function showAction(Person $person)
    {
        if ($this->getUser() !== $person->getUser()) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $deleteForm = $this->createDeleteForm($person->getId());

        return [
            'entity' => $person,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Person entity.
     *
     * @param Person $person Person
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}/edit", name="person_edit")
     * @Method("GET")
     * @ParamConverter("person", class="AppBundle:Person")
     * @Template()
     */
    public function editAction(Person $person)
    {
        if ($this->getUser() !== $person->getUser()) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $editForm = $this->createEditForm($person);
        $deleteForm = $this->createDeleteForm($person->getId());

        return [
            'entity' => $person,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Person entity.
     *
     * @param Person $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Person $entity)
    {
        $form = $this->createForm(new PersonType(), $entity, [
            'action' => $this->generateUrl('person_update', [
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
     * Edits an existing Person entity.
     *
     * @param Request $request Request
     * @param Person  $person  Person
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/{id}", name="person_update")
     * @Method("PUT")
     * @ParamConverter("person", class="AppBundle:Person")
     * @Template("AppBundle:Person:edit.html.twig")
     */
    public function updateAction(Request $request, Person $person)
    {
        if ($this->getUser() !== $person->getUser()) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($person->getId());
        $editForm = $this->createEditForm($person);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('person_show', [
                'id' => $person->getId(),
            ]));
        }

        return [
            'entity' => $person,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Person entity.
     *
     * @param Person $person Person
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/{id}", name="person_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Person $person)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        return $this->redirect($this->generateUrl('person'));
    }

    /**
     * Creates a form to delete a Person entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('person_delete', [
                        'id' => $id,
                    ]))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', [
                        'label' => 'Delete',
                    ])
                    ->getForm();
    }
}
