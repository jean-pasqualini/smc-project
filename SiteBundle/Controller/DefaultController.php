<?php

namespace Smc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;

use Symfony\Component\Security\Core\SecurityContext;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    private $blocks = array(
    		"debug" => array(),
    		"header" => array(),
    		"middle" => array(),
    		"footer" => array()
		);
	
	public function loginAction()
	{
		$request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('SmcSiteBundle:Security:loginextend.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
	}
	
	
    public function indexAction($page = "home", $parametres = array())
    {
    	// Permet de declarer des parametres au modules
		
    	foreach($parametres as $servicename => $liste_parametres)
		{
			$this->get($servicename)->setParametres($liste_parametres);
		}
		
        return $this->render('SmcSiteBundle::layout.html.twig', array(
			"pagename" => $page
		));
	}
		
	public function demonstrationAction(Placement $moduleTarget)
	{
		$em = $this->getDoctrine()->getEntityManager();

		foreach($em->getRepository("SmcSiteBundle:Placement")->findAll() as $placeModule)
		{
			$module = $placeModule->getModule();
			
			if($placeModule->getId() == $moduleTarget)
			{
				$this->blocks[$placeModule->getPosition()][$module->getNom()] = $this->forward($module->getNamespace().":Default:demonstration",
					array(
					)
				)->getContent();
			}
			else {
				$this->getAffichage($placeModule);
			}
		}

        return $this->render('SmcSiteBundle::layout.html.twig', array('blocks' => $this->blocks));
	}
	
	public function configurerAction(Placement $placeModule)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$module = $placeModule->getModule();

		return new Response($this->get($placeModule->getServiceName())->getConfiguration($placeModule));

		$this->get($placeModule->getServiceName());

		return new Response($placeModule->getServiceName());
	}
	
	public function removeModuleAction(Placement $placeModule)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$em->remove($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function changeColorModuleAction(Placement $placeModule)
	{
		$color = $this->getRequest()->request->get("color");
		
		if(empty($color))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setColor($color);
		
		$em->persist($placeModule);
		
		$em->flush($placeModule);
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setNombreColonneModuleAction(Placement $placeModule)
	{
		$nombrecolonne = $this->getRequest()->request->get("nombrecolonne");
		
		if(empty($nombrecolonne))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setNombreColonne($nombrecolonne);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setPrependAction(Placement $placeModule)
	{
		$nombrecolonne = $this->getRequest()->request->get("nombrecolonne");
		
		if(!isset($nombrecolonne))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setPrepend($nombrecolonne);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setAppendAction(Placement $placeModule)
	{
		$nombrecolonne = $this->getRequest()->request->get("nombrecolonne");
		
		if(!isset($nombrecolonne))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setAppend($nombrecolonne);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setFloatModuleAction(Placement $placeModule)
	{
		$isFloat = $this->getRequest()->request->get("isFloat");
		
		if(empty($isFloat))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setIsFloat($isFloat);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function moveModuleAction(Placement $placeModule)
	{
		$position = $this->getRequest()->request->get('position');
		
		if(empty($position))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setPosition($position);
		
		$placeModule->setOrdre(0);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setMarginTopModuleAction(Placement $placeModule)
	{
		$isMarginTop = $this->getRequest()->request->get('isMarginTop');
		
		if(empty($isMarginTop))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setMarginTop($isMarginTop);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function setMarginBottomModuleAction(Placement $placeModule)
	{
		$isMarginBottom = $this->getRequest()->request->get('isMarginBottom');
		
		if(empty($isMarginBottom))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Des paramètres sont manquants"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$placeModule->setMarginBottom($isMarginBottom);
		
		$em->persist($placeModule);
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function changeOrdreModuleAction($position)
	{
		$ordre = $this->getRequest()->request->get('placement');
	
		if(empty($ordre))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Il manque l'ordre"
			)));
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		
		foreach($em->getRepository("SmcSiteBundle:Placement")->findAll() as $placeModule)
		{
			if(($ordre_module = array_search($placeModule->getId(), $ordre)) !== false)
			{
				$placeModule->setOrdre($ordre_module);
				$em->persist($placeModule);
			}
		}
		
		$em->flush();
		
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function updateSystemAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		foreach($em->getRepository("SmcSiteBundle:Placement")->findAll() as $placement)
		{
			$color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			$placement->setIdentifiantColor($color);
			
			$em->persist($placement);
		}
		
		$em->flush();
		
		return new Response("Succes");
	}
	
	public function addModuleAction($module_id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$module = $this->get($module_id);
		
		$position = $this->getRequest()->request->get('position');
	
		if(empty($position))
		{
			return new Response(json_encode(array(
				"etat" => false,
				"message" => "Il manque la position"
			)));
		}
				
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    	$color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		
		$moduleAdd = new Placement;
				
		$moduleAdd->setIdentifiantColor($color);
		
		$moduleAdd->setOrdre(0);
		
		$moduleAdd->setIsFloat(false);
		
		$moduleAdd->setColor("ffffff");
		
		$moduleAdd->setNombreColonne(0);
		
		$moduleAdd->setPosition($position);
		
		$moduleAdd->setServiceName($module_id);
		
		$moduleAdd->setPrepend(0);
		
		$moduleAdd->setAppend(0);
				
		$em->persist($moduleAdd);
		
		$em->flush();
	
		$retour = array(
			"etat" => true
		);
		
		return new Response(json_encode($retour));
	}
	
	public function sousoffreAction()
	{
		return $this->render("SmcSiteBundle:Sousoffre:sousoffre.html.twig");
	}
	
	public function offrefinaleAction()
	{
		return $this->render("SmcSiteBundle:Offrefinale:offrefinale.html.twig");
	}
	
	public function getModulesService()
	{
		$services = $this->container->getServiceIds();
		
		$modules = array();
		
		foreach($services as $service)
		{
			if(preg_match ("/smc.modules/i", $service))
			{
				$module = $this->get($service);
				
				$modules[] = array(
					"serviceName" => $service,
					"name" => $module->getName(),
					"version" => $module->getVersion(),
					"demonstration" => $module->getAffichage()
				);
			}
		}
		
		return $modules;
	}
	
	public function testServiceAction()
	{
		$horloge = $this->get("smc.modules.horloge");
		
		//$affichage = $horloge->getAffichage();
		
		//echo var_dump(get_class_methods(get_class($this->container)));
		
		$modules = $this->getModulesService();
		
		return $this->render("SmcSiteBundle:Default:testservice.html.twig", array("modules" => $modules));
	}
}
