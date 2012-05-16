<?php

namespace Smc\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smc\SiteBundle\Entity\Design
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Design
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
     * @var string $fontFamilly
     *
     * @ORM\Column(name="fontFamilly", type="string", length=255)
     */
    private $fontFamilly;

    /**
     * @var string $weight
     *
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @var string $fontSize
     *
     * @ORM\Column(name="fontSize", type="string", length=255)
     */
    private $fontSize;

    /**
     * @var string $cornerRadius
     *
     * @ORM\Column(name="cornerRadius", type="string", length=255)
     */
    private $cornerRadius;

    /**
     * @var string $backgroundColor
     *
     * @ORM\Column(name="backgroundColor", type="string", length=255)
     */
    private $backgroundColor;

    /**
     * @var string $backgroundImage
     *
     * @ORM\Column(name="backgroundImage", type="string", length=255)
     */
    private $backgroundImage;

    /**
     * @var string $borderColor
     *
     * @ORM\Column(name="borderColor", type="string", length=255)
     */
    private $borderColor;

    /**
     * @var smallint $borderSize
     *
     * @ORM\Column(name="borderSize", type="smallint")
     */
    private $borderSize;

    /**
     * @var string $textColor
     *
     * @ORM\Column(name="textColor", type="string", length=255)
     */
    private $textColor;

    /**
     * @var smallint $paddingTop
     *
     * @ORM\Column(name="paddingTop", type="smallint")
     */
    private $paddingTop;

    /**
     * @var smallint $paddingBottom
     *
     * @ORM\Column(name="paddingBottom", type="smallint")
     */
    private $paddingBottom;

    /**
     * @var smallint $paddingLeft
     *
     * @ORM\Column(name="paddingLeft", type="smallint")
     */
    private $paddingLeft;

    /**
     * @var smallint $paddingRight
     *
     * @ORM\Column(name="paddingRight", type="smallint")
     */
    private $paddingRight;

    /**
     * @var smallint $marginTop
     *
     * @ORM\Column(name="marginTop", type="smallint")
     */
    private $marginTop;

    /**
     * @var smallint $marginBottom
     *
     * @ORM\Column(name="marginBottom", type="smallint")
     */
    private $marginBottom;

    /**
     * @var smallint $marginLeft
     *
     * @ORM\Column(name="marginLeft", type="smallint")
     */
    private $marginLeft;

    /**
     * @var smallint $marginRight
     *
     * @ORM\Column(name="marginRight", type="smallint")
     */
    private $marginRight;

    /**
     * @var string $borderType
     *
     * @ORM\Column(name="borderType", type="string", length=255)
     */
    private $borderType;


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
     * Set fontFamilly
     *
     * @param string $fontFamilly
     */
    public function setFontFamilly($fontFamilly)
    {
        $this->fontFamilly = $fontFamilly;
    }

    /**
     * Get fontFamilly
     *
     * @return string 
     */
    public function getFontFamilly()
    {
        return $this->fontFamilly;
    }

    /**
     * Set weight
     *
     * @param string $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set fontSize
     *
     * @param string $fontSize
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }

    /**
     * Get fontSize
     *
     * @return string 
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Set cornerRadius
     *
     * @param string $cornerRadius
     */
    public function setCornerRadius($cornerRadius)
    {
        $this->cornerRadius = $cornerRadius;
    }

    /**
     * Get cornerRadius
     *
     * @return string 
     */
    public function getCornerRadius()
    {
        return $this->cornerRadius;
    }

    /**
     * Set backgroundColor
     *
     * @param string $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * Get backgroundColor
     *
     * @return string 
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set backgroundImage
     *
     * @param string $backgroundImage
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * Get backgroundImage
     *
     * @return string 
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * Set borderColor
     *
     * @param string $borderColor
     */
    public function setBorderColor($borderColor)
    {
        $this->borderColor = $borderColor;
    }

    /**
     * Get borderColor
     *
     * @return string 
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    /**
     * Set borderSize
     *
     * @param smallint $borderSize
     */
    public function setBorderSize($borderSize)
    {
        $this->borderSize = $borderSize;
    }

    /**
     * Get borderSize
     *
     * @return smallint 
     */
    public function getBorderSize()
    {
        return $this->borderSize;
    }

    /**
     * Set textColor
     *
     * @param string $textColor
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * Get textColor
     *
     * @return string 
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set paddingTop
     *
     * @param smallint $paddingTop
     */
    public function setPaddingTop($paddingTop)
    {
        $this->paddingTop = $paddingTop;
    }

    /**
     * Get paddingTop
     *
     * @return smallint 
     */
    public function getPaddingTop()
    {
        return $this->paddingTop;
    }

    /**
     * Set paddingBottom
     *
     * @param smallint $paddingBottom
     */
    public function setPaddingBottom($paddingBottom)
    {
        $this->paddingBottom = $paddingBottom;
    }

    /**
     * Get paddingBottom
     *
     * @return smallint 
     */
    public function getPaddingBottom()
    {
        return $this->paddingBottom;
    }

    /**
     * Set paddingLeft
     *
     * @param smallint $paddingLeft
     */
    public function setPaddingLeft($paddingLeft)
    {
        $this->paddingLeft = $paddingLeft;
    }

    /**
     * Get paddingLeft
     *
     * @return smallint 
     */
    public function getPaddingLeft()
    {
        return $this->paddingLeft;
    }

    /**
     * Set paddingRight
     *
     * @param smallint $paddingRight
     */
    public function setPaddingRight($paddingRight)
    {
        $this->paddingRight = $paddingRight;
    }

    /**
     * Get paddingRight
     *
     * @return smallint 
     */
    public function getPaddingRight()
    {
        return $this->paddingRight;
    }

    /**
     * Set marginTop
     *
     * @param smallint $marginTop
     */
    public function setMarginTop($marginTop)
    {
        $this->marginTop = $marginTop;
    }

    /**
     * Get marginTop
     *
     * @return smallint 
     */
    public function getMarginTop()
    {
        return $this->marginTop;
    }

    /**
     * Set marginBottom
     *
     * @param smallint $marginBottom
     */
    public function setMarginBottom($marginBottom)
    {
        $this->marginBottom = $marginBottom;
    }

    /**
     * Get marginBottom
     *
     * @return smallint 
     */
    public function getMarginBottom()
    {
        return $this->marginBottom;
    }

    /**
     * Set marginLeft
     *
     * @param smallint $marginLeft
     */
    public function setMarginLeft($marginLeft)
    {
        $this->marginLeft = $marginLeft;
    }

    /**
     * Get marginLeft
     *
     * @return smallint 
     */
    public function getMarginLeft()
    {
        return $this->marginLeft;
    }

    /**
     * Set marginRight
     *
     * @param smallint $marginRight
     */
    public function setMarginRight($marginRight)
    {
        $this->marginRight = $marginRight;
    }

    /**
     * Get marginRight
     *
     * @return smallint 
     */
    public function getMarginRight()
    {
        return $this->marginRight;
    }

    /**
     * Set borderType
     *
     * @param string $borderType
     */
    public function setBorderType($borderType)
    {
        $this->borderType = $borderType;
    }

    /**
     * Get borderType
     *
     * @return string 
     */
    public function getBorderType()
    {
        return $this->borderType;
    }
}