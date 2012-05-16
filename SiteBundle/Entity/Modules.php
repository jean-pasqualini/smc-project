<?php

namespace Smc\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\SiteBundle\Entity\Modules
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\SiteBundle\Entity\ModulesRepository")
 */
class Modules
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
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string $version
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var string $auteur
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

	/**
	 * @var string $namespace
	 * 
	 * @ORM\Column(name="namespace", type="string", length=255)
	 */
	private $namespace;
	
	
	/**
	 * @var boolean $editable
	 * 
	 * @ORM\Column(name="editable", type="boolean")
	 */
	private $editable;

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
	 * Is editable
	 * 
	 * @return boolean
	 */
	public function isEditable()
	{
		return $this->editable;
	}
	
	/**
	 * Set editable
	 * 
	 * @param boolean $editable
	 */
	public function setEditable($editable)
	{
		$this->editable = $editable;
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
	 * Get namespace
	 * 
	 * @return string
	 */
	public function getNamespace()
	{
		return $this->namespace;	
	}
	
	/**
	 * Set namespace
	 * 
	 * @param string $namespace
	 */
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
	}
	
    /**
     * Set version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}