<?php
    namespace Smc\Module\ManageModuleBundle\Service;
    	
	use Smc\SiteBundle\Entity\Placement;
		
	class ManageModule implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
		private $templating;
		private $em;
		private $container;
		
		public function __construct($em, $container)
		{
			$this->em = $em;
			$this->container = $container;
		}
		
		public function setTemplating($templating)
		{
			$this->templating = $templating;
		}
		
		public function getName()
		{
			return "Gestion des modules";
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
	    	$em = $this->em;
			
			$modules = array();
			
			$smcextension = $this->container->get("twig.extension.smc");		
			
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
						
	        return $this->templating->render('SmcModuleManageModuleBundle:Default:afficher.html.twig', array(
				"modules" => $modules,
				"placements" => $placements
			));
		}
		
		public function getDemonstration()
		{
			return date("d/m/y");
		}
		
		public function getConfiguration(Placement $modulePlace)
		{
			
		}
	}
    
?>