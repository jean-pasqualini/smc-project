<?php

namespace Smc\Module\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\Module\MenuBundle\Entity\ModuleMenuConfiguration
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\MenuBundle\Entity\ModuleMenuConfigurationRepository")
 */
class ModuleMenuConfiguration
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
     * @var string $BackgroundMenu
     *
     * @ORM\Column(name="BackgroundMenu", type="string", length=255)
     */
    private $BackgroundMenu;

    /**
     * @var string $BackgroundItem
     *
     * @ORM\Column(name="BackgroundItem", type="string", length=255)
     */
    private $BackgroundItem;

    /**
     * @var string $ColorTextItem
     *
     * @ORM\Column(name="ColorTextItem", type="string", length=255)
     */
    private $ColorTextItem;

    /**
     * @var integer $PlacementId
     *
     * @ORM\Column(name="placementId", type="integer")
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
     * Set BackgroundMenu
     *
     * @param string $backgroundMenu
     */
    public function setBackgroundMenu($backgroundMenu)
    {
        $this->BackgroundMenu = $backgroundMenu;
    }

    /**
     * Get BackgroundMenu
     *
     * @return string 
     */
    public function getBackgroundMenu()
    {
        return $this->BackgroundMenu;
    }

    /**
     * Set BackgroundItem
     *
     * @param string $backgroundItem
     */
    public function setBackgroundItem($backgroundItem)
    {
        $this->BackgroundItem = $backgroundItem;
    }

    /**
     * Get BackgroundItem
     *
     * @return string 
     */
    public function getBackgroundItem()
    {
        return $this->BackgroundItem;
    }

    /**
     * Set ColorTextItem
     *
     * @param string $colorTextItem
     */
    public function setColorTextItem($colorTextItem)
    {
        $this->ColorTextItem = $colorTextItem;
    }

    /**
     * Get ColorTextItem
     *
     * @return string 
     */
    public function getColorTextItem()
    {
        return $this->ColorTextItem;
    }

    /**
     * Set PlacementId
     *
     * @param integer $placementId
     */
    public function setPlacementId($placementId)
    {
        $this->placementId = $placementId;
    }

    /**
     * Get PlacementId
     *
     * @return integer 
     */
    public function getPlacementId()
    {
        return $this->placementId;
    }
}