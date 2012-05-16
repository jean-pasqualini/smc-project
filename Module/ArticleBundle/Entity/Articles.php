<?php

namespace Smc\Module\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Smc\SiteBundle\Entity\Placement;
/**
 * Smc\Module\ArticleBundle\Entity\Articles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\ArticleBundle\Entity\ArticlesRepository")
 */
class Articles
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text $contenu
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

	/**
	 * @var smallint $placementId
	 * 
	 * @ORM\ManyToOne(targetEntity="Smc\SiteBundle\Entity\Placement")
	 */
	private $placementId;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }
    
	/**
	 * Get placementId
	 * 
	 * @return smallint
	 */
	public function getPlacementId()
	{
		return $this->placementId;
	}
	
	/**
	 * Set plactementId
	 * 
	 * @param smallint $placementId
	 */
	public function setPlacementId(Placement $placementId)
	{
		$this->placementId = $placementId;
	}
	

    /**
     * Set contenu
     *
     * @param text $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Get contenu
     *
     * @return text 
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}