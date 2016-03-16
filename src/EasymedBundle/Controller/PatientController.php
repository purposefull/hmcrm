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
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
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
     * @return []
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
     * @Route("/add", name="patient_add")
     * @Template()
     *
     * @return []
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

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Edits patient.
     *
     * @Route("/edit/{id}", name="patient_edit")
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

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * Deletes patient.
     *
     * @Route("/delete/{id}", name="patient_delete")
     *
     * @param Request $request
     * @param         $id
     *
     * @return []|\Symfony\Component\HttpFoundation\RedirectResponse
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
