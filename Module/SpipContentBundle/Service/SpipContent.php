<?php
    namespace Smc\Module\SpipContentBundle\Service;
	
	use Smc\SiteBundle\Entity\Placement;

    class SpipContent implements \Smc\SiteBundle\Interfaces\IModuleBase {
    	
		private $templating;
		private $em;		
		
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
			return "Spip Content";
		}
		
		public function getNom()
		{
			return "Spip Content";
		}
		
		public function getVersion()
		{
			return "1.0";
		}
		
		public function getServiceDependances()
		{
			
		}
		
		public function getJsFiles()
		{
			
		}
		
		public function getCssFiles()
		{
			
		}
		
		public function isEditable()
		{
			return true;
		}
		
		public function getAffichage(Placement $modulePlace)
		{
			$articles = $this->em->getRepository("SpipAccesContentBundle:SpipArticles")->findAll();
						
			return $this->templating->render("SmcModuleSpipContentBundle:Default:list.html.twig", array(
				"articles" => $articles
			));
		}
		
		public function getDemonstration()
		{
			return "demonstration de spip content";
		}
		
		public function getConfiguration(Placement $modulePlace)
		{
			
		}
    }
?>