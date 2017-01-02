<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;

/**
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @return Response
     *
     * @Route("/", name="product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $entities = $em->getRepository('AppBundle:Product')->findByUser($user);

        return [
            'entities' => $entities,
        ];
    }

    /**
     * Creates a new Product entity.
     *
     * @param Request $request Request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/", name="product_create")
     * @Method("POST")
     * @Template("AppBundle:Product:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Product();

        $form = $this->createForm(
            ProductType::class,
            $entity,
            [
                'action' => $this->generateUrl('product_create'),
                'method' => 'POST',
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', [
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
     * @Route("/new", name="product_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Product();

        $form = $this->createForm(
            ProductType::class,
            $entity,
            [
                'action' => $this->generateUrl('product_create'),
                'method' => 'POST',
            ]
        );

        return [
            'entity' => $entity,
            'form' => $form->createView(),
        ];
    }

    /**
     * Finds and displays a Product entity.
     *
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/show/{id}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('id'));

        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return [
            'entity' => $product
        ];
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/edit/{id}", name="product_edit")
     *
     * @Template()
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('id'));

        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createForm(ProductType::class, $product, [
            'action' => $this->generateUrl('product_edit', [
                'id' => $product->getId(),
            ]),
        ]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $product = $editForm->getData();
            $em->persist($product);
            $em->flush();
        }

        return [
            'entity' => $product,
            'edit_form' => $editForm->createView()
        ];
    }

    /**
     * Deletes a Product entity.
     *
     * @param Request $request
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="product_delete")
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($request->get('id'));

        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('product'));
    }
}
