<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="user_profile")
     */
    public function profileAction()
    {
        // edit password, email, phone
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * CRUD for email templates stored in db.
     *
     * @Route("/email_template", name="email_template")
     * @Template()
     */
    public function emailTemplateAction()
    {
        return [];
    }

    /**
     * CRUD for products stored in db.
     *
     * @Route("/product", name="product")
     * @Template()
     */
    public function productAction()
    {
        return [];
    }
}
