<?php
namespace EasymedBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DoctorController
 * @package EasymedBundle\Controller
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
