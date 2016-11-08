<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Contact;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * Lists all Contact entities.
     *
     * @return Response
     *
     * @Route("/", name="contact_list")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AppBundle:Contact')->createQueryBuilder('c')
                    ->where('c.user = :user')
                    ->setParameter('user', $this->getUser())
                    ->orderBy('c.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult();

        $resultArray = [];

        foreach ($query as $item) {
            $resultArray[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'type' => 'person_show',
            ];
        }

        return [
            'entities' => $resultArray,
        ];
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @param Contact $contact Contact
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/show/{id}", name="contact_show")
     * @Method("GET")
     * @ParamConverter("contact", class="AppBundle:Contact")
     * @Template()
     */
    public function showAction(Contact $contact)
    {
        if ($this->getUser() !== $contact->getUser()) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $deleteForm = $this->createDeleteForm($contact->getId());

        return [
            'entity' => $contact,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a new Contact entity.
     *
     * @param Request $request Request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/new", name="contact_new")
     * @Method({"GET", "POST"})
     * @Template("AppBundle:Contact:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $contact->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', [
                'id' => $contact->getId(),
            ]));
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Contact entity.
     *
     * @param Contact $contact Contact
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/edit/{id}", name="contact_edit")
     * @Method("GET")
     * @ParamConverter("contact", class="AppBundle:Contact")
     * @Template()
     */
    public function editAction(Contact $contact)
    {
        if ($this->getUser() !== $contact->getUser()) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $editForm = $this->createEditForm($contact);
        $deleteForm = $this->createDeleteForm($contact->getId());

        return [
            'entity' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Edits an existing Contact entity.
     *
     * @param Request $request Request
     * @param Contact $contact Contact
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/update/{id}", name="contact_update")
     * @Method({"GET", "PUT"})
     * @ParamConverter("contact", class="AppBundle:Contact")
     * @Template("AppBundle:Contact:edit.html.twig")
     */
    public function updateAction(Request $request, Contact $contact)
    {
        if ($this->getUser() !== $contact->getUser()) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($contact->getId());
        $editForm = $this->createEditForm($contact);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contact_show', [
                'id' => $contact->getId(),
            ]));
        }

        return [
            'entity' => $contact->getId(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Contact entity.
     *
     * @param Contact $contact Contact
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="contact_delete")
     * @ParamConverter("contact", class="AppBundle:Contact")
     */
    public function deleteAction(Contact $contact)
    {
        if ($this->getUser() !== $contact->getUser()) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        return $this->redirect($this->generateUrl('contact_list'));
    }

    /**
     * Creates a form to edit a Contact entity.
     *
     * @param Contact $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Contact $entity)
    {
        $form = $this->createForm(new ContactType(), $entity, [
            'action' => $this->generateUrl('contact_update', [
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
     * Creates a form to delete a Contact entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('contact_delete', [
                        'id' => $id,
                    ]))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', [
                        'label' => 'Delete',
                    ])
                    ->getForm();
    }
}
