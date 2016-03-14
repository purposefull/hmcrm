<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use EasymedBundle\Entity\Patient;
use EasymedBundle\Form\Type\PatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PatientController.
 *
 * @Route("/patient")
 */
class PatientController extends Controller
{
    /**
     * Returns list of patients.
     *
     * @Route("/list", name="patient_index")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $patients = $this->getDoctrine()
            ->getRepository('EasymedBundle:Patient')
            ->findAll();

        return array(
            'patients' => $patients,
        );
    }

    /**
     * Adds patient.
     *
     * @Route("/add", name="patient_add")
     * @Template()
     *
     * @return array
     */
    public function addAction(Request $request)
    {
        $patient = new Patient();

        $form = $this->createForm(new PatientType(), $patient);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($patient);
                $em->flush();

                return $this->redirect($this->generateUrl('patient_index'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Edits patient.
     *
     * @Route("/edit/{id}", name="patient_edit")
     * @Template()
     *
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws EntityNotFoundException
     */
    public function editAction(Request $request, $id)
    {
        $patient = $this->getDoctrine()
            ->getRepository('EasymedBundle:Patient')
            ->find($id);

        if (!$patient) {
            throw new EntityNotFoundException();
        }

        $form = $this->createForm(new PatientType(), $patient);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('patient_index'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Deletes patient.
     *
     * @Route("/delete/{id}", name="patient_delete")
     *
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws EntityNotFoundException
     */
    public function deleteAction(Request $request, $id)
    {
        $patient = $this->getDoctrine()
            ->getRepository('EasymedBundle:Patient')
            ->find($id);

        if (!$patient) {
            throw new EntityNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($patient);
        $em->flush();

        return $this->redirect($this->generateUrl('patient_index'));
    }
}
