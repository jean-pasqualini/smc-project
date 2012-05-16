<?php
    namespace Smc\Module\MenuBundle\Service;
    	
	use Smc\SiteBundle\Entity\Placement;
		
	class Menu implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
		private $templating;
		private $em;
		private static $numberRender = 0;
				
		public function __construct($em)
		{
			$this->em = $em;
		}
		
		public function setTemplating($templating)
		{
			$this->templating = $templating;
		}
		
		public function getName()
		{
			return "Menu";
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
			self::$numberRender++;
								
			$items = $this->em->getRepository("SmcModuleMenuBundle:ModuleMenuItems")->findBy(array("parent" => null, "placementId" => $modulePlace->getID()));
			
			return $this->templating->render("SmcModuleMenuBundle:Default:afficher.html.twig", array(
				"items" => $items,
				"module" => $modulePlace,
				"nombreinstance" => self::getNombreAffichage()
			));
		}
		
		public static function getNombreAffichage()
		{
			return self::$numberRender;
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