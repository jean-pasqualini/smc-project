<?php
	namespace Smc\SiteBundle\Interfaces;

	use Smc\SiteBundle\Entity\Placement;

    interface IModuleBase {
    	
    	public function setTemplating($templating);
		
		public function getName();
		
		public function getNom();
		
		public function getVersion();
		
		public function getServiceDependances();
		
		public function getJsFiles();
		
		public function getCssFiles();
		
		public function isEditable();
		
		public function getAffichage(Placement $modulePlace);
		
		public function getDemonstration();
		
		public function getConfiguration(Placement $modulePlace);

    }
?>