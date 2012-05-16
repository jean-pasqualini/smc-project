<?php

namespace Smc\Module\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\Module\ArticleBundle\Entity\ModuleArticleConfiguration
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\ArticleBundle\Entity\ModuleArticleConfigurationRepository")
 */
class ModuleArticleConfiguration
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
     * @var string $TitleBackgroundColor
     *
     * @ORM\Column(name="TitleBackgroundColor", type="string", length=255)
     */
    private $TitleBackgroundColor;


	/**
	 * @var string $TitlesTextColor
	 * 
	 * @ORM\Column(name="TitlesTextColor", type="string", length=255)
	 */
	private $TitlesTextColor;
	 
	/**
	 * @var smallint $placementId
	 * 
	 * @ORM\Column(name="placementid", type="smallint")
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
	public function setPlacementId($placementId)
	{
		$this->placementId = $placementId;
	}
	
	/**
	 * Get TitlesTextColor
	 * 
	 * @return string 
	 */
	public function getTitlesTextColor()
	{
		return $this->TitlesTextColor;
	}

	/**
	 * Set TitlesTextColor
	 * 
	 * @param string $TitlesTextColor
	 */
	public function setTitlesTextColor($TitlesTextColor)
	{
		$this->TitlesTextColor = $TitlesTextColor;
	}
	
    /**
     * Set color
     *
     * @param string $color
     */
    public function setTitleBackgroundColor($TitleBackgroundColor)
    {
        $this->TitleBackgroundColor = $TitleBackgroundColor;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getTitleBackgroundColor()
    {
        return $this->TitleBackgroundColor;
    }
}