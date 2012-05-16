<?php

namespace Smc\Module\SlideshowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// On utilise le namespace de la classe Response.
use Symfony\Component\Httpfoundation\Response;

class DefaultController extends Controller
{
    
    public function demonstrationAction()
    {
        return new Response("Demo de slidedhow");
    }
	
	public function afficherAction()
	{
		return new Response("Affichage du slideshow");
	}
}
