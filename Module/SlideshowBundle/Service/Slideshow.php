<?php
    namespace Smc\Module\SlideshowBundle\Service;
    	
	use Smc\SiteBundle\Entity\Placement;
		
	class Slideshow implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
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
			return "Slideshow";
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
			return date("d/m/y");
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