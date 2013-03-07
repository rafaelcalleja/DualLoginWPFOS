<?php

namespace RC\DualLoginWPFOSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RCDualLoginWPFOSBundle:Default:index.html.twig', array('name' => $name));
    }
}
