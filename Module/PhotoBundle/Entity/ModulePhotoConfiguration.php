<?php

namespace Smc\Module\PhotoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Smc\Module\PhotoBundle\Entity\Document;

/**
 * Smc\Module\PhotoBundle\Entity\ModulePhotoConfiguration
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\PhotoBundle\Entity\ModulePhotoConfigurationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ModulePhotoConfiguration
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
     * @var integer $largeur
     *
     * @ORM\Column(name="largeur", type="string", length=255)
     */
    private $largeur = 200;

    /**
     * @var integer $hauteur
     *
     * @ORM\Column(name="hauteur", type="string", length=255)
     */
    private $hauteur = 200;

    /**
     * @var integer $placementId
     *
     * @ORM\Column(name="placementId", type="integer")
     */
    private $placementId;

	/**
	 * @ORM\OneToOne(targetEntity="Document")
	 */
	private $document;

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
     * Set largeur
     *
     * @param integer $largeur
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;
    }

    /**
     * Get largeur
     *
     * @return integer 
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * Set hauteur
     *
     * @param integer $hauteur
     */
    public function setHauteur($hauteur)
    {
        $this->hauteur = $hauteur;
    }

	/**
	 * Get document
	 * 
	 * @return Document 
	 */
	public function getDocument()
	{
		return $this->document;
	}
	
	/**
	 * Set document
	 * 
	 * @param Document $document
	 */
	public function setDocument(Document $document)
	{
		$this->document = $document;
	}

    /**
     * Get hauteur
     *
     * @return integer 
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * Set placementId
     *
     * @param integer $placementId
     */
    public function setPlacementId($placementId)
    {
        $this->placementId = $placementId;
    }

    /**
     * Get placementId
     *
     * @return integer 
     */
    public function getPlacementId()
    {
        return $this->placementId;
    }
}