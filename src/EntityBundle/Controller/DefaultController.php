<?php

namespace EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EntityBundle:Default:index.html.twig');
    }
}
