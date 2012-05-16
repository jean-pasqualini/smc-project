<?php
    namespace Smc\Module\ArticleBundle\Service;
    	
	use Smc\SiteBundle\Entity\Modules;
	use Smc\SiteBundle\Entity\Placement;
	use Smc\Module\ArticleBundle\Entity\ModuleArticleConfiguration;
	
	
	use Smc\Module\ArticleBundle\Entity\Articles;
	
	use Smc\Module\ArticleBundle\Form\ModuleArticleConfigurationType;
		
	class Article implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
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
			return "Article";
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
	    	$articles = array();
				
			$articles = $this->em->getRepository("SmcModuleArticleBundle:Articles")->findByPlacementId($modulePlace->getId());
			
			if(empty($articles))
			{
				$articles = new Articles();
			}
					
	        return $this->templating->render('SmcModuleArticleBundle:Default:articles.html.twig', array(
	        	"articles" => $articles,
	        	"module" => $modulePlace
			));
		}
		
		public function getDemonstration()
		{
			$articles = array(
				array("titre" => "titre d'un article", "contenu" => "contenu d'un article")
			);
			
	        return $this->templating->render('SmcModuleArticleBundle:Default:articles.html.twig', array(
	        	'articles' => $articles
			));
		}
		
		public function getConfiguration(Placement $modulePlace)
		{
			
		}
	}
    
?>