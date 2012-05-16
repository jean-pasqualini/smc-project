<?php
namespace Smc\SiteBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;

//use Symfony\Component\Form\Form;

use Smc\Module\MenuBundle\Entity\ModuleMenuItems;

use Smc\Module\MenuBundle\Controller\DefaultController;

use Smc\SiteBundle\Entity\Modules;
use Smc\SiteBundle\Entity\Placement;

use Smc\SiteBundle\Form\DesignType;
use Smc\SiteBundle\Entity\Design;

class SmcExtension extends \Twig_Extension
{
	private $em;
	private $httpkernel;
	private $formFactory;
	private $container;
	private $modules;
	
	
	private static $nombreModuleAfficher = 0;
		
    public function __construct($entityManager, $httpkernel, $formFactory, $container)
    {
    	$this->em = $entityManager;
		$this->httpkernel = $httpkernel;
		$this->formFactory = $formFactory;
		$this->container = $container;
		
		$this->modules = $this->getModulesService();
    }

	public function getModulesService()
	{
		$services = $this->container->getServiceIds();
		
		$modules = array();
		
		foreach($services as $service)
		{
			if(preg_match ("/smc.modules/i", $service))
			{
				$module = $this->container->get($service);
				
				$modules[$service] = $module;
			}
		}
		
		return $modules;
	}
	
	public function getLoadModules()
	{
		return $this->modules;
	}

	public function isLoadModule($name)
	{
		return array_key_exists($name, $this->modules);
	}

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {		
        return array(
            'ViewModulesSmc' => new \Twig_Function_Method($this, 'ViewModulesSmc'),
            'SmcGetModuleFromPlacement' => new \Twig_Function_Method($this, 'SmcGetModuleFromPlacement'),
        );
    }
	
	public function SmcGetModuleFromPlacement(Placement $placement)
	{
		if($placement->getServiceName() == null)
		{
			return $placement->getModule();
		}
		else 
		{
			return $this->container->get($placement->getServiceName());	
		}
	}
   
    /**
     * Converts a string to time
     *
     * @param string $string
     * @return int
     */
    public function ViewModulesSmc($position)
    {
    	foreach($this->modules as $module)
    	{
    		$module->setTemplating($this->container->get("templating"));
		}
				
    	$blocks = array();
		
		//$page = $this->em->getRepository("SmcModuleMenuBundle:ModuleMenuItems")->find(3);
			
		$modules = $this->em->getRepository("SmcSiteBundle:Placement")->findBy(array("position" => $position), array("ordre" => "asc"));
		//$modules = $this->em->getRepository("SmcSiteBundle:Placement")->findModules($position, $page);
					
		foreach($modules as $placeModule)
		{
			if($placeModule->getServiceName() == null)
			{
				$blocks[] = $this->getAffichage($placeModule);
			}
			else {
				$blocks[] = $this->getServiceAffichage($placeModule);
			}
		}
	
	    return $blocks;
    }

	public function getAffichage(Placement $placeModule)
	{
		$block = array();
		
		$module = $placeModule->getModule();
		
		$personaliseForm = $this->formFactory->create(new DesignType());
		
		$personaliseForm = $personaliseForm->createView();
		
			$block = array(
				"identifiantColor" => $placeModule->getIdentifiantColor(),
				"editable" => $module->isEditable(),
				"id" => $placeModule->getId(),
				"nom" => $module->getNom(),
				"prepend" => $placeModule->getPrepend(),
				"append" => $placeModule->getAppend(),
				"personaliseForm" => $personaliseForm,
				"nombrecolonne" => $placeModule->getNombreColonne(),
				"color" => $placeModule->getColor(),
				"isMarginTop" => $placeModule->isMarginTop(),
				"isMarginBottom" => $placeModule->isMarginBottom(),
				"isfloat" => $placeModule->isFloat(),
				"content" => array(
					"main" => $this->httpkernel->forward($module->getNamespace().":Default:afficher",
						array(
							"modulePlace" => $placeModule
						)
					)->getContent(),
					/*
					"configuration" => $this->httpkernel->forward($module->getNamespace().":Default:configurer",
						array(
							"modulePlace" => $placeModule
						)
					)->getContent()
					*/
				)
				);
				
		return $block;
	}

	public function getServiceAffichage(Placement $placeModule)
	{
		$block = array();
		
		$module = $this->modules[$placeModule->getServiceName()];
		
		$personaliseForm = $this->formFactory->create(new DesignType());
		
		$personaliseForm = $personaliseForm->createView();
		
			$block = array(
				"identifiantColor" => $placeModule->getIdentifiantColor(),
				"editable" => $module->isEditable(),
				"id" => $placeModule->getId(),
				"nom" => $module->getName(),
				"prepend" => $placeModule->getPrepend(),
				"append" => $placeModule->getAppend(),
				"personaliseForm" => $personaliseForm,
				"nombrecolonne" => $placeModule->getNombreColonne(),
				"color" => $placeModule->getColor(),
				"isMarginTop" => $placeModule->isMarginTop(),
				"isMarginBottom" => $placeModule->isMarginBottom(),
				"isfloat" => $placeModule->isFloat(),
				"content" => array(
					"main" => $module->getAffichage($placeModule),
					/*
					"configuration" => $this->httpkernel->forward($module->getNamespace().":Default:configurer",
						array(
							"modulePlace" => $placeModule
						)
					)->getContent()
					*/
				)
				);
				
		return $block;
	}

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Smc';
    }
}