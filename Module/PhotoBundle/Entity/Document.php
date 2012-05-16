<?php

namespace Smc\Module\PhotoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Smc\Module\PhotoBundle\Entity\Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\Module\PhotoBundle\Entity\DocumentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Document
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
	 * @Assert\File(maxSize="60000000")
	 */
	public $fichier;

	 /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name = "test";

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $path;
	
	public function getPath()
	{
		return $this->path;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getFichier()
	{
		return $this->fichier;
	}

	public function setPath($path)
	{
		$this->path = $path;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function setFichier($fichier)
	{
		$this->fichier = $fichier;
	}

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
    	//throw new \Exception(__DIR__.'/../../../../../web/'.$this->getUploadDir());
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
	
	public function __toString() {
	    return $this->path;
	}
	
	public function upload()
	{
	    // the file property can be empty if the field is not required
	    if (null === $this->fichier) {
	        return;
	    }
	
	    // we use the original file name here but you should
	    // sanitize it at least to avoid any security issues
	
	    // move takes the target directory and then the target filename to move to
	    $this->fichier->move($this->getUploadRootDir(), $this->fichier->getClientOriginalName());
	
	    // set the path property to the filename where you'ved saved the file
	    $this->path = $this->fichier->getClientOriginalName();
	
	    // clean up the file property as you won't need it anymore
	    $this->fichier = null;
	}
	
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->fichier) {
            // do whatever you want to generate a unique name
            $this->path = uniqid().'.'.$this->fichier->guessExtension();
        }
    }
	
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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
}