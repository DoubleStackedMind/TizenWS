<?php

namespace WebServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebServiceBundle:Default:index.html.twig');
    }
}
