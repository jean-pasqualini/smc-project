<?php

namespace Smc\Module\MenuBundle\Entity;

use Smc\SiteBundle\Entity\Placement;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\Module\MenuBundle\Entity\ModuleMenuItems
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\MenuBundle\Entity\ModuleMenuItemsRepository")
 */
class ModuleMenuItems
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
	 * @var placementId
	 * 
	 * @ORM\ManyToOne(targetEntity="Smc\SiteBundle\Entity\Placement")
	 */
	private $placementId;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string $lien
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

	/**
	 * @var ModuleMenuItems $parent
	 * 
	 * @ORM\ManyToOne(targetEntity="ModuleMenuItems")
	 */
	private $parent = null;
	
	/**
	 * Get parent
	 * 
	 * @return ModuleMenuItems
	 */
	public function getParent()
	{
		return $this->parent;
	}
	
	/**
	 * Set parent
	 * 
	 * @param ModuleMenuItems $parent
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;
	}
	
	/**
	 * Add Children
	 * 
	 * @param ModuleMenuItems $children
	 */
	public function addChildren($children)
	{
		$children->setParent($this);
	}
	
	/**
	 * Get Childrens
	 * 
	 * @return ArrayCollection
	 */
	public function getChildrens()
	{
		return array();
	}
	
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
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set lien
     *
     * @param string $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

	/**
	 * Get placementId
	 * 
	 * @return Placement
	 */
	public function getPlacementId()
	{
		return $this->placementId;
	}
	
	/**
	 * Set placementId
	 * 
	 * @param Placement $placement
	 */
	public function setPlacementID(Placement $placement)
	{
		$this->placementId = $placement;
	}
	 
}