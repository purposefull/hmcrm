<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use EasymedBundle\Entity\Doctor;
use EasymedBundle\Form\Type\DoctorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DoctorController.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/doctor")
 */
class DoctorController extends Controller
{
    /**
     * Returns list of doctors.
     *
     * @return Response
     *
     * @Route("/list", name="doctor_index")
     * @Template()
     */
    public function indexAction()
    {
        $doctors = $this->getDoctrine()
                        ->getRepository('EasymedBundle:Doctor')
                        ->findAll();

        return [
            'doctors' => $doctors,
        ];
    }

    /**
     * Adds doctor.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     *
     * @Route("/add", name="doctor_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $doctor = new Doctor();

        $form = $this->createForm(new DoctorType(), $doctor);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctor);
            $em->flush();

            return $this->redirect($this->generateUrl('doctor_index'));
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Edits doctor.
     *
     * @param Request $request Request
     * @param Doctor  $doctor  Doctor
     *
     * @return RedirectResponse|Response
     *
     * @throws EntityNotFoundException
     *
     * @Route("/edit/{id}", name="doctor_edit")
     * @ParamConverter("deal", class="EasymedBundle:Doctor")
     * @Template()
     */
    public function editAction(Request $request, Doctor $doctor)
    {
        $form = $this->createForm(new DoctorType(), $doctor);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('doctor_index'));
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Deletes doctor.
     *
     * @Route("/delete/{id}", name="doctor_delete")
     *
     * @param Doctor $doctor Doctor
     *
     * @return RedirectResponse
     *
     * @throws EntityNotFoundException
     */
    public function deleteAction(Doctor $doctor)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($doctor);
        $em->flush();

        return $this->redirect($this->generateUrl('doctor_index'));
    }
}
