<?php
    namespace Smc\Module\PhotoBundle\Service;
    	
	use Smc\SiteBundle\Entity\Placement;
		
	use Smc\Module\PhotoBundle\Entity\ModulePhotoConfiguration;
	use Smc\Module\PhotoBundle\Form\ModulePhotoConfigurationType;
		
	class Photo implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
		private $templating;
		private $em;
		private $container;
		
		public static $nombre_instance = 0;
		
		public function __construct($em, $container)
		{
			$this->em = $em;
			$this->container = $container;
			$this->form = $container->get("form.factory");
		}
		
		public function setTemplating($templating)
		{
			$this->templating = $templating;
		}
		
		public function getName()
		{
			return "Photo";
		}
		
		public function getNom()
		{
			return $this->getName();
		}
		
		public function getVersion()
		{
			return "1.0";
		}
		
		public function getServiceDependances()
		{
			return array();
		}
		
		public function getJsFiles()
		{
			return array();
		}
		
		public function getCssFiles()
		{
			return array();
		}
		
		public function isEditable()
		{
			return true;	
		}
		
		public function getAffichage(Placement $modulePlace)
		{
			Photo::$nombre_instance++;
			
			$em = $this->em;
		
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
			
			return $this->templating->render("SmcModulePhotoBundle:Default:afficher.html.twig", array(
				"nombre_instance" => Photo::$nombre_instance,
				"module" => $modulePlace,
				"largeur" => $configuration->getLargeur(),
				"hauteur" => $configuration->getHauteur(),
				"image_url" => $image_url
			));
		}
		
		public function getDemonstration()
		{
			return date("d/m/y");
		}
		
		public function getRequest()
		{
			return $this->container->get("request");
		}
		
		public function getEntityConfiguration(Placement $modulePlace)
		{
			$em = $this->em;
		
			$configuration = $em->getRepository("SmcModulePhotoBundle:ModulePhotoConfiguration")->findOneByPlacementId($modulePlace->getId());
			
			if(empty($configuration))
			{
				$configuration = new ModulePhotoConfiguration();
				
				$configuration->setPlacementId($modulePlace->getId());
			}
			
			return $configuration;
		}
		
		public function getConfiguration(Placement $modulePlace)
		{
			$em = $this->em;
			
			$request = $this->getRequest();
				
			$configuration = $this->getEntityConfiguration($modulePlace);
			
			$form = $this->form->createBuilder(new ModulePhotoConfigurationType(), $configuration)->getForm();
			
			//$fichier = new Document();
					
			if($request->getMethod() == "POST")
			{
				$form->bindRequest($request);
				
				if($form->isValid())
				{
					 
					 $configuration = $form->getData();
					 
					 //$configuration->setDocument($fichier);
					 
					 $em->persist($configuration);
					 
					 $em->persist($configuration->getDocument());
					 //$em->persist($fichier);
					 
					 $em->flush();
					 
					 return new Response(json_encode(array(
						"etat" => true,
						"image_url" => $configuration->getDocument()->getWebPath()
					)));
				}
			}
			
			return $this->container->get("templating")->render("SmcModulePhotoBundle:Default:configurer.html.twig", array(
				"nombre_instance" => 1,
				"form" => $form->createView(),
				"module" => $modulePlace
			));
		}
	}
    
?>