<?php

namespace Smc\Module\BarrePartenaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    
    public function afficherAction()
    {
        return $this->render('SmcModuleBarrePartenaireBundle:Default:afficher.html.twig');
    }
	
	public function demonstrationAction()
	{
		return new Response("Demo de la barre de partenaire");
	}
}
