<?php

namespace Smc\Module\HorlogeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    
    public function afficherAction()
    {
        return $this->render('SmcModuleHorlogeBundle:Default:afficher.html.twig', array(
			"HEURE" => date("d/m/y H:i:s")
		));
    }
	
	public function configurerAction()
	{
		return new Response("il n'y a rien a configurer");
	}
	
	public function demonstrationAction()
	{
        return $this->render('SmcModuleHorlogeBundle:Default:afficher.html.twig', array(
			"HEURE" => date("d/m/y H:i:s")
		));
	}
}
