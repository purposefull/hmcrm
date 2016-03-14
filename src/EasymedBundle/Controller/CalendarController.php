<?php

namespace EasymedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DoctorController.
 *
 * @Route("/calendar")
 */
class CalendarController extends Controller
{
    /**
     * @Route("/index", name="calendar_index")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
