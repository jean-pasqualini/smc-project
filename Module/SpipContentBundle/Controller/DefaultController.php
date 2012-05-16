<?php

namespace Smc\Module\SpipContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('SmcModuleSpipContentBundle:Default:index.html.twig', array('name' => $name));
    }
}
