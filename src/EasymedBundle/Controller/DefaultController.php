<?php

namespace EasymedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * DefaultController class
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 */
class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EasymedBundle:Default:index.html.twig', [
            'name' => $name
        ]);
    }
}
