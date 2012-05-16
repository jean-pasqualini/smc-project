<?php

namespace Smc\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\SiteBundle\Entity\Placement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\SiteBundle\Entity\PlacementRepository")
 */
class Placement
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
     * @var ModuleMenuItems $pages
     *
     * @ORM\ManyToMany(targetEntity="Smc\Module\MenuBundle\Entity\ModuleMenuItems")
     */
    private $pages;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string", length=255)
     */
    private $position;
	
	
	/**
	 * @var smallint $ordre
	 * @ORM\Column(name="ordre", type="smallint");
	 */
	private $ordre;

    /**
     * @var object $module
     *
     * @ORM\ManyToOne(targetEntity="Smc\SiteBundle\Entity\Modules")
     */
    private $module = null;


	/**
	 * @var string $color
	 * 
	 * @ORM\Column(name="color", type="string")
	 */
	private $color;
	
	/**
	 * @var boolean $isfloat
	 * 
	 * @ORM\Column(name="isfloat", type="boolean")
	 */
	private $isfloat = false;
	
	/**
	 * @var boolean $isMarginTop
	 * 
	 * @ORM\Column(name="isMarginTop", type="boolean")
	 */
	private $isMarginTop = false;
	
	/**
	 * @var boolean $isMarginBottom
	 * 
	 * @ORM\Column(name="isMarginBottom", type="boolean")
	 */
	private $isMarginBottom = false;
	
	/**
	 * @var smallint $nombrecolonne
	 * 
	 * @ORM\Column(name="nombrecolonne", type="smallint")
	 */
	private $nombrecolonne = 12;
	
	/**
	 * @var smallint $prepend
	 * 
	 * @ORM\Column(name="prepend", type="smallint")
	 */
	private $prepend = 0;
	
	/**
	 * @var smallint $append
	 * 
	 * @ORM\Column(name="append", type="smallint")
	 */
	private $append = 0;
	
	/**
	 * @var string $servicename
	 * 
	 * @ORM\Column(name="servicename", type="string", nullable = true)
	 */
	private $servicename;
	
	/**
	 * @var string $identifiantColor
	 * 
	 * @ORM\Column(name="identifiantColor", type="string")
	 */
	private $identifiantColor = "ffffff";
	
	public function __construct(){
		$this->pages = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * Get prepend
	 * 
	 * @return smallint
	 */
	public function getPrepend()
	{
		return $this->prepend;
	}
	
	/**
	 * Get servicename
	 * 
	 * @return string
	 */
	public function getServiceName()
	{
		return $this->servicename;
	}
	
	/**
	 * Set servicename
	 * 
	 * @param string $servicename
	 */
	public function setServiceName($servicename)
	{
		$this->servicename = $servicename;
	}
	
	/**
	 * Get append
	 * 
	 * @return smallint
	 */
	public function getAppend()
	{
		return $this->append;
	}
	
	/**
	 * Set prepend
	 * 
	 * @param smallint $prepend
	 */
	public function setPrepend($prepend)
	{
		$this->prepend = $prepend;
	}
	
	/**
	 * Set append
	 * 
	 * @param smallint $append
	 */
	public function setAppend($append)
	{
		$this->append = $append;
	}
	
	/**
	 * Set identifiantColor
	 * 
	 * @param string $identifiantColor
	 */
	public function setIdentifiantColor($identifiantColor)
	{
		$this->identifiantColor = $identifiantColor;
	}
	
	/**
	 * Get identifiantColor
	 * 
	 * @return string 
	 */
	public function getIdentifiantColor()
	{
		return $this->identifiantColor;
	}
	
	/**
	 * Get color
	 * 
	 * @return string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * Get isfloat
	 * 
	 * @return boolean
	 */
	public function isFloat()
	{
		return $this->isfloat;
	}
	
	/**
	 * Set isfloat
	 * 
	 * @param boolean $isfloat
	 */
	public function setIsFloat($isfloat)
	{
		$this->isfloat = $isfloat;
	}
	
	public function __toString()
	{
		return $this->getPosition()." (".$this->getId().")";
	}
	
	/**
	 * Get isMarginTop
	 * 
	 * @return boolean
	 */
	public function isMarginTop()
	{
		return $this->isMarginTop;
	}
	
	/**
	 * Set isMarginTop
	 * 
	 * @param boolean $isfloat
	 */
	public function setMarginTop($isMarginTop)
	{
		$this->isMarginTop = $isMarginTop;
	}
	
	/**
	 * Get isMarginBottom
	 * 
	 * @return boolean
	 */
	public function isMarginBottom()
	{
		return $this->isMarginBottom;
	}
	
	/**
	 * Set isMarginBottom
	 * 
	 * @param boolean $isMarginBottom
	 */
	public function setMarginBottom($isMarginBottom)
	{
		$this->isMarginBottom = $isMarginBottom;
	}
	
	/**
	 * Get nombrecolonne
	 * 
	 * @return smallint
	 */
	public function getNombreColonne()
	{
		return $this->nombrecolonne;
	}
	
	/**
	 * Set nombrecollone
	 * 
	 * @param smallint $nombrecolonne
	 */
	public function setNombreColonne($nombrecolonne)
	{
		$this->nombrecolonne = $nombrecolonne;
	}
	
	 
    /**
     * Set Page
     *
     * @param ModuleMenuItems $page
     */
    public function addPage(ModuleMenuItems $page)
    {
        $this->pages[] = $page;
    }
	
    /**
     * Get Pages
     *
     * @return ModuleMenuItems 
     */
    public function getPages()
    {
        return $this->pages;
    }

	/**
	 * Set color
	 * 
	 * @param string $color
	 */
	public function setColor($color)
	{
		$this->color = $color;
	}

    /**
     * Set position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

	/**
	 * Set ordre
	 * 
	 * @param smallint $ordre
	 */
	public function setOrdre($ordre)
	{
		$this->ordre = $ordre;
	}
	
	/**
	 * Get ordre
	 * 
	 * @return smallint
	 */
	public function getOrdre()
	{
		return $this->ordre;
	}

    /**
     * Set module
     *
     * @param Modules $module
     */
    public function setModule(\Smc\SiteBundle\Entity\Modules $module)
    {
        $this->module = $module;
    }

    /**
     * Get module
     *
     * @return Modules 
     */
    public function getModule()
    {
        return $this->module;
    }
}