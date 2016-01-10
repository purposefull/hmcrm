<?php

namespace EasymedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use EasymedBundle\Entity\Contact;

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
     * @Route("/", name="contact_list")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $query = $em->getRepository('EasymedBundle:Contact')->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $this->getUser())
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        $resultArray = array();

        foreach ($query as $item) {
            switch ($item->getType()) {
                case Contact::TYPE_PERSON:
                    $resultArray[] = array('id' => $item->getPerson()->getId(), 'name' => $item->getName(), 'type' => 'person_show');
                    break;
                case Contact::TYPE_COMPANY:
                    $resultArray[] = array('id' => $item->getCompany()->getId(), 'name' => $item->getName(), 'type' => 'company_show');
                    break;
            }
        }

        return array(
            'entities' => $resultArray
        );
    }
}