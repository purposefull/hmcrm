<?php

namespace AppBundle\Controller;

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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityNotFoundException;
use AppBundle\Form\Type\ProductType;

/**
 * Lead controller.
 *
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
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
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
     * Displays a form to create a new Product entity.
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
     * Creates a form to create a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Product $entity)
    {
        $form = $this->createForm(ProductType::class,
            $entity,
            [
               'action' => $this->generateUrl('product_create'),
               'method' => 'POST',
            ]);

        return $form;
    }

    /**
     * @throws EntityNotFoundException
     *
     * @return RedirectResponse
     *
     * @Route("/product_capture_form", name="product_capture_form")
     * @Template()
     */
    public function productCaptureFormAction(Request $request)
    {
        if ($request->getMethod() == 'POST' || $request->getMethod() == 'GET') {
            // $form = $request->request->all();

            $product = new Product();

            if ($request->get('userId')) {
                $product->setName($request->get('name'));
                $product->setPrice($request->get('price'));
                $product->setDeals($request->get('deals'));
                $product->setCurrency($request->get('currency'));

                $user = $this->getDoctrine()
                    ->getRepository('AppBundle:User')
                    ->find($request->get('userId'));

                if ($user) {
                    $product->setUser($user);
                } else {
                    throw new EntityNotFoundException();
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
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
     * @Route("/product_capture_form_settings", name="product_capture_form_settings")
     * @Template()
     */
    public function productCaptureFormSettingsAction()
    {
        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return [];
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

    /**
     * Finds and displays a Product entity.
     *
     * @param Product $product Product
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/show/{id}", name="product_show")
     * @Method("GET")
     * @ParamConverter("product", class="AppBundle:Product")
     * @Template()
     */
    public function showAction(Product $product)
    {
        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($product->getId());

        return [
            'entity' => $product,
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @param Product $product Product
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     *
     * @Route("/edit/{id}", name="product_edit")
     * @Method("GET")
     * @ParamConverter("product", class="AppBundle:Product")
     * @Template()
     */
    public function editAction(Product $product)
    {
        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($product);
        $deleteForm = $this->createDeleteForm($product->getId());

        return [
            'entity' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, [
            'action' => $this->generateUrl('product_update', [
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
     * Edits an existing Product entity.
     *
     * @param Request $request Request
     * @param Product    $product    Product
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse|Response
     *
     * @Route("/update/{id}", name="product_update")
     * @Method("PUT")
     * @ParamConverter("product", class="AppBundle:Product")
     * @Template("AppBundle:Product:edit.html.twig")
     */
    public function updateAction(Request $request, Product $product)
    {
        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($product->getId());
        $editForm = $this->createEditForm($product);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', [
                'id' => $product->getId(),
            ]));
        }

        return [
            'entity' => $product->getId(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ];
    }

    /**
     * Deletes a Product entity.
     *
     * @param Product $product Product
     *
     * @throws NotFoundHttpException
     *
     * @return RedirectResponse
     *
     * @Route("/delete/{id}", name="product_delete")
     * @ParamConverter("product", class="AppBundle:Product")
     */
    public function deleteAction(Product $product)
    {
        if ($this->getUser() !== $product->getUser()) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        // insurance
//        $em = $this->getDoctrine()->getManager();
//        $em->remove($lead);
//        $em->flush();

        return $this->redirect($this->generateUrl('product'));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', [
                'id' => $id,
            ]))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, [
                'label' => 'Delete',
            ])
            ->getForm();
    }
}
