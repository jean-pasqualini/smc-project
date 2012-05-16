<?php

namespace Smc\Module\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;

use Smc\Module\MenuBundle\Entity\ModuleMenuItems;

use Smc\Module\MenuBundle\Entity\ModuleMenuConfiguration;
use Smc\Module\MenuBundle\Form\ModuleMenuConfigurationType;

class DefaultController extends Controller
{
	
	public static $nombreinstance = 0;

	public function __construct()
	{
		DefaultController::$nombreinstance++;
	}

	public static function getNombreInstances()
	{
		return DefaultController::$nombreinstance;
	}

	public function afficherAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
				
		$items = $em->getRepository("SmcModuleMenuBundle:ModuleMenuItems")->findBy(array("parent" => null, "placementId" => $modulePlace->getID()));
		
		return $this->render("SmcModuleMenuBundle:Default:afficher.html.twig", array(
			"items" => $items,
			"module" => $modulePlace,
			"nombreinstance" => DefaultController::getNombreInstances()
		));
	}
	
	public function configurerAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
	
		$configuration = $em->getRepository("SmcModuleMenuBundle:ModuleMenuConfiguration")->findOneByPlacementId($modulePlace->getId());
		
		if(empty($configuration))
		{
			$configuration = new ModuleMenuConfiguration();
			
			$configuration->setPlacementId($modulePlace->getId());
		}
		
		$form = $this->createForm(new ModuleMenuConfigurationType(), $configuration);
		
		$request = $this->getRequest();
		
		if($request->getMethod() == 'POST') 
		{
		
			$form->bindRequest($request);
			
			if( $form->isValid() )
	        {		
				$configuration = $form->getData();
				
				$em = $this->getDoctrine()->getEntityManager();
				
				$em->persist($configuration);
				
				$em->flush($configuration);
				
				$SUCCESS[] = "Votre module à bien été configurer";
				
				return new Response(json_encode(array(
					"etat" => true
				)));
			}
		}
		
		return $this->render("SmcModuleMenuBundle:Default:configurer.html.twig", array(
			"form" => $form->createView(),
			"module" => $modulePlace
		));
	}
	
	public function demonstrationAction()
	{
		return $this->render("SmcModuleMenuBundle:Default:afficher.html.twig", array('items' => array(
			array("id" => 0, "lien" => "", "nom" => "lien 1"),
			array("id" => 0, "lien" => "", "nom" => "lien 2"),
			array("id" => 0, "lien" => "", "nom" => "lien 3")
		),"nombreinstance" => DefaultController::getNombreInstances()));
	}
	
	public function addItemAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
			
		$item = new ModuleMenuItems();
		
		$item->setPlacementID($modulePlace);
		
		$item->setNom("Nouveau");
		
		$item->setLien("test");

		$em->persist($item);
		
		$em->flush();
		
		return new Response(json_encode(array(
			"etat" => true
		)));

	}
	
	public function editTitleItemAction(ModuleMenuItems $item)
	{
		$nom = $this->getRequest()->request->get("value");
		
		if(empty($nom))
		{
			return new Response("erreur");
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$item->setNom($nom);
		
		$em->persist($item);
		
		$em->flush();
		
		return new Response($nom);
	}
}
