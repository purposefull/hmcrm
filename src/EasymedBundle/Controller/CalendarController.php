<?php

namespace EasymedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DoctorController.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @Route("/calendar")
 */
class CalendarController extends Controller
{
    /**
     * @Route("/index", name="calendar_index")
     * @Template()
     *
     * @return []
     */
    public function indexAction()
    {
        return [];
    }
}
