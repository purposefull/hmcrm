<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/", name="user_profile")
     */
    public function profileAction()
    {

        
        return $this->redirect($this->generateUrl('homepage'));
    }
}
