<?php

namespace Smc\Module\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;
use Smc\Module\ArticleBundle\Entity\ModuleArticleConfiguration;


use Smc\Module\ArticleBundle\Entity\Articles;

use Smc\Module\ArticleBundle\Form\ModuleArticleConfigurationType;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
	private $configuration = array(
		"color" => "ffffff"
	);
    
    public function afficherAction(Placement $modulePlace)
    {
    	$em = $this->getDoctrine()->getEntityManager();
		
    	$articles = array();
			
		$articles = $em->getRepository("SmcModuleArticleBundle:Articles")->findByPlacementId($modulePlace->getId());
		
		if(empty($articles))
		{
			$articles = new Articles();
		}
				
        return $this->render('SmcModuleArticleBundle:Default:articles.html.twig', array(
        	"articles" => $articles,
        	"module" => $modulePlace
		));
    }
	
	public function configurerAction(Placement $modulePlace)
	{
	
		$em = $this->getDoctrine()->getEntityManager();
	
		$configuration = $em->getRepository("SmcModuleArticleBundle:ModuleArticleConfiguration")->findOneByPlacementId($modulePlace->getId());
		
		if(empty($configuration))
		{
			$configuration = new ModuleArticleConfiguration();
			
			$configuration->setPlacementId($modulePlace->getId());
		}
		
		$form = $this->createForm(new ModuleArticleConfigurationType(), $configuration);
		
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
		
		return $this->render("SmcModuleArticleBundle:Default:configuration.html.twig",
			 array(
			 	"module" => $modulePlace,
			 	"form" => $form->createView()
			 )
		 );
	}
	
	public function demonstrationAction()
	{
		$articles = array(
			array("titre" => "titre d'un article", "contenu" => "contenu d'un article")
		);
		
        return $this->render('SmcModuleArticleBundle:Default:articles.html.twig', array(
        	'articles' => $articles
		));
	}
	
	public function getCssAction(Placement $modulePlace)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
    	$configuration = $em->getRepository("SmcModuleArticleBundle:ModuleArticleConfiguration")->findOneByPlacementId($modulePlace->getId());

		if(empty($configuration))
		{
			return new Response("");
		}
		
		$reponse = $this->render("SmcModuleArticleBundle:Css:articles.css.twig", array(
			"configuration" => $configuration,
			"module" => $modulePlace
		));
		
		$reponse->headers->set('Content-Type', 'text/css');
		
		return $reponse;
	}
}
