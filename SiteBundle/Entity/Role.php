<?php

namespace Smc\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Smc\SiteBundle\Entity\Role
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\SiteBundle\Entity\RoleRepository")
 */
class Role implements RoleInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;


	public function __construct()
	{
		$this->createdAt = new \DateTime();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
	
	public function __toString() {
	    return $this->getName();
	}
	
	/**
	 * Get role
	 * 
	 * @return string
	 */
	public function getRole()
	{
		return $this->getName();
	}

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}