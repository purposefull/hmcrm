<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use EasymedBundle\Entity\Doctor;
use EasymedBundle\Form\Type\DoctorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/list", name="doctor_index")
     * @Template()
     *
     * @return []
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
     * @Route("/add", name="doctor_add")
     * @Template()
     *
     * @return []
     */
    public function addAction(Request $request)
    {
        $doctor = new Doctor();

        $form = $this->createForm(new DoctorType(), $doctor);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($doctor);
                $em->flush();

                return $this->redirect($this->generateUrl('doctor_index'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Edits doctor.
     *
     * @Route("/edit/{id}", name="doctor_edit")
     * @Template()
     *
     * @param Request $request
     * @param         $id
     *
     * @return []|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws EntityNotFoundException
     */
    public function editAction(Request $request, $id)
    {
        $doctor = $this->getDoctrine()
                       ->getRepository('EasymedBundle:Doctor')
                       ->find($id);

        if (!$doctor) {
            throw new EntityNotFoundException();
        }

        $form = $this->createForm(new DoctorType(), $doctor);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('doctor_index'));
            }
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
     * @param Request $request
     * @param         $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws EntityNotFoundException
     */
    public function deleteAction(Request $request, $id)
    {
        $doctor = $this->getDoctrine()
                       ->getRepository('EasymedBundle:Doctor')
                       ->find($id);

        if (!$doctor) {
            throw new EntityNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($doctor);
        $em->flush();

        return $this->redirect($this->generateUrl('doctor_index'));
    }
}
