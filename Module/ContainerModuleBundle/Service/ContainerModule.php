<?php
    namespace Smc\Module\ContainerModuleBundle\Service;
    	
	class ContainerModule implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
		private $templating;
		
		public function __construct()
		{
			
		}
		
		public function setTemplating($templating)
		{
			$this->templating = $templating;
		}
		
		public function getName()
		{
			return "Conteneur de module";
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
		
		public function getAffichage()
		{
			return $this->templating->render("SmcModuleContainerModuleBundle:Default:afficher.html.twig", array(
				"name" => "container_dynamic_".$modulePlace->getId()
			));
		}
		
		public function getDemonstration()
		{
			return date("d/m/y");
		}
		
		public function getConfiguration()
		{
			
		}
	}
    
?>