<?php

namespace Smc\Module\ManageModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    public function afficherAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
		
		$modules = array();
		
		$smcextension = $this->get("twig.extension.smc");		
		
		foreach($em->getRepository("SmcSiteBundle:Modules")->findAll() as $module)
		{
			$modules[] = array(
			"id" => $module->getId(),
			"nom" => $module->getNom(),
			"isservice" => false,
			"content" => $this->forward($module->getNamespace().":Default:demonstration",
					array(
					)
				)->getContent()
			);	
		}
		
		foreach($smcextension->getLoadModules() as $servicename => $module)
		{
			$modules[] = array(
				"id" => $servicename,
				"isservice" => true,
				"nom" => $module->getName(),
				"content" => $module->getDemonstration()
			);	
		}
		
		$placements = $em->getRepository("SmcSiteBundle:Placement")->findAll();
		
		
		
        return $this->render('SmcModuleManageModuleBundle:Default:afficher.html.twig', array(
			"modules" => $modules,
			"placements" => $placements
		));
    }
	
	public function demonstrationAction()
	{
		return new Response("Demonstration du module managemodule ");
	}
	
	public function configurerAction()
	{
		return new Response("Aucune configuration néscésaire");
	}
	
}
