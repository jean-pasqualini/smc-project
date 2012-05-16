<?php

namespace Smc\Module\ContainerModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('SmcModuleContainerModuleBundle:Default:index.html.twig', array('name' => $name));
    }
	
	public function afficherAction(Placement $modulePlace)
	{
		return $this->render("SmcModuleContainerModuleBundle:Default:afficher.html.twig", array(
			"name" => "container_dynamic_".$modulePlace->getId()
		));
	}
	
	public function demonstrationAction()
	{
		return new Response("Demo du module conteneur de module");
	}
	
	public function configurerAction()
	{
		return new Response("Aucune configuration pour le conteneur de module");
	}
}
