<?php

namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use EasymedBundle\Entity\Patient;
use EasymedBundle\Form\Type\PatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PatientController.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/patient")
 */
class PatientController extends Controller
{
    /**
     * Returns list of patients.
     *
     * @return Response
     *
     * @Route("/list", name="patient_index")
     * @Template()
     */
    public function indexAction()
    {
        $patients = $this->getDoctrine()
                         ->getRepository('EasymedBundle:Patient')
                         ->findAll();

        return [
            'patients' => $patients,
        ];
    }

    /**
     * Adds patient.
     *
     * @param Request $request Request
     *
     * @return Response
     *
     * @Route("/add", name="patient_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $patient = new Patient();

        $form = $this->createForm(new PatientType(), $patient);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            return $this->redirect($this->generateUrl('patient_index'));
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Edits patient.
     *
     * @param Request $request Request
     * @param Patient $patient Patient
     *
     * @return RedirectResponse|RedirectResponse
     *
     * @Route("/edit/{id}", name="patient_edit")
     * @Template()
     */
    public function editAction(Request $request, Patient $patient)
    {
        $form = $this->createForm(new PatientType(), $patient);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('patient_index'));
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Deletes patient.
     *
     * @param Patient $patient Patient
     *
     * @return RedirectResponse|Response
     *
     * @Route("/delete/{id}", name="patient_delete")
     */
    public function deleteAction(Patient $patient)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($patient);
        $em->flush();

        return $this->redirect($this->generateUrl('patient_index'));
    }
}
