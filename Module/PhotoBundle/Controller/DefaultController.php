<?php

namespace Smc\Module\PhotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;

use Smc\Module\PhotoBundle\Entity\ModulePhotoConfiguration;
use Smc\Module\PhotoBundle\Form\ModulePhotoConfigurationType;

use Smc\Module\PhotoBundle\Entity\Document;
use Smc\Module\PhotoBundle\Form\DocumentType;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    
	public static $nombre_instance = 0;
	
	public function afficherAction(Placement $modulePlace)
	{
		DefaultController::$nombre_instance++;
		
		$em = $this->getDoctrine()->getEntityManager();
	
		$configuration = $em->getRepository("SmcModulePhotoBundle:ModulePhotoConfiguration")->findOneByPlacementId($modulePlace->getId());
		
		if(empty($configuration))
		{
			$configuration = new ModulePhotoConfiguration();
			
			$configuration->setPlacementId($modulePlace->getId());
		}
		
		$Document = $configuration->getDocument();
		
		if($Document === null)
		{
			$image_url = "uploads/documents/default.png";
		}
		else {
			$image_url = $Document->getWebPath();
		}
		
		return $this->render("SmcModulePhotoBundle:Default:afficher.html.twig", array(
			"nombre_instance" => DefaultController::$nombre_instance,
			"module" => $modulePlace,
			"largeur" => $configuration->getLargeur(),
			"hauteur" => $configuration->getHauteur(),
			"image_url" => $image_url
		));
	}
	
	public function demonstrationAction()
	{
		return $this->render("SmcModulePhotoBundle:Default:demonstration.html.twig");
	}
	
	public function getConfiguration(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
	
		$configuration = $em->getRepository("SmcModulePhotoBundle:ModulePhotoConfiguration")->findOneByPlacementId($modulePlace->getId());
		
		if(empty($configuration))
		{
			$configuration = new ModulePhotoConfiguration();
			
			$configuration->setPlacementId($modulePlace->getId());
		}
		
		return $configuration;
	}
	
	public function resizePhotoAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
	
		$configuration = $this->getConfiguration($modulePlace);
		
		$largeur = $this->getRequest()->request->get("largeur");
		$hauteur = $this->getRequest()->request->get("hauteur");
		
		if(empty($largeur) || empty($hauteur))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "des paramètres sont manquant"
			)));
		}
		
		$configuration->setLargeur($largeur);
		
		$configuration->setHauteur($hauteur);
		
		$em->persist($configuration);
		
		$em->flush($configuration);
		
		return new Response(json_encode(array(
			"etat" => true
		)));
	}
	
	public function configurerAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$request = $this->getRequest();
	
		$configuration = $this->getConfiguration($modulePlace);
		
		$form = $this->createForm(new ModulePhotoConfigurationType(), $configuration);
		
		//$fichier = new Document();
				
		if($request->getMethod() == "POST")
		{
			$form->bindRequest($request);
			
			if($form->isValid())
			{
				 
				 $configuration = $form->getData();
				 
				 //$configuration->setDocument($fichier);
				 
				 $em->persist($configuration);
				 //$em->persist($fichier);
				 
				 $em->flush();
				 
				 return new Response(json_encode(array(
					"etat" => true,
					"image_url" => $configuration->getDocument()->getWebPath()
				)));
			}
		}
		
		return $this->render("SmcModulePhotoBundle:Default:configurer.html.twig", array(
			"nombre_instance" => DefaultController::$nombre_instance,
			"form" => $form->createView(),
			"module" => $modulePlace
		));
	}
	
	public function changePhotoAction(Placement $modulePlace)
	{
		$file = $this->getRequest()->files->get("imagefile");
				
		$em = $this->getDoctrine()->getEntityManager();
		
		$configuration = $this->getConfiguration($modulePlace);
		
		$document = new Document();
				
		$document->setFichier($file);
		
		$document->upload();
		
		$configuration->setDocument($document);
		
		$em->persist($document);
		$em->persist($configuration);
		
		$em->flush();
		
		$retour = new \stdClass();
		
		$retour->filename = $document->getWebPath();
		$retour->path = "/";
		$retour->img = '<img src="'.$document->getWebPath().'" alt="image" />';
		
		return new Response(json_encode($retour));
	}
}
