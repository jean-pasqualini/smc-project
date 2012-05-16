<?php
    namespace Smc\Module\LoginBundle\Service;
    	
	use Smc\SiteBundle\Entity\Placement;
		
	use Symfony\Component\Security\Core\SecurityContext;
		
	class Login implements \Smc\SiteBundle\Interfaces\IModuleBase {
		
		private $templating;
		private $container;
		private $request;
		private $session;
		
		public function __construct($container)
		{
			$this->container = $container;
			
			$this->request = $this->container->get("request");
			$this->session = $this->container->get("session");	
		}
		
		public function setTemplating($templating)
		{
			$this->templating = $templating;
		}
		
		public function getName()
		{
			return "Authentification";
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
			return $this->getDemonstration();
		}
		
		public function getRequest()
		{
			return $this->request;
		}
		
		public function getSession()
		{
			return $this->session;
		}
		
		public function getDemonstration()
		{
			$request = $this->getRequest();
	        $session = $request->getSession();
	
	        // get the login error if there is one
	        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
	            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
	        } else {
	            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
	        }
	
	        return $this->templating->render('SmcModuleLoginBundle:Security:login.html.twig', array(
	            // last username entered by the user
	            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
	            'error'         => $error,
	        ));
		}
		
		public function getConfiguration()
		{
			
		}
	}
    
?>