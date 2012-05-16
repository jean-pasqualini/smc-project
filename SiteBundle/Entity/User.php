<?php

namespace Smc\SiteBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Smc\SiteBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Smc\SiteBundle\Entity\UserRepository")
 */
class User implements UserInterface
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
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;


    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $password;   
    

    /**
     * @ORM\ManyToMany(targetEntity="Smc\SiteBundle\Entity\Role")
     * 
	 * @var ArrayCollection $userRoles
     */
    protected $userRoles;   

	public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->userRoles = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }    

    /**
     * Gets the DateTime the role was created.
     *
     * @return DateTime A DateTime object.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
	 * Get roles
	 * 
	 * @return string
	 */
	public function getRoles()
	{
		return $this->getUserRoles()->toArray();
	}
	
	/**
	 * Get the user roles
	 * 
	 * @return ArrayCollection
	 */
	public function getUserRoles()
	{
		return $this->userRoles;
	}
	
	/**
	 * Get password
	 * 
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 * Get salt
	 * 
	 * return string
	 */	
	 public function getSalt()
	 {
	 	return "";
	 }
	 
	 
	/**
	 * Set password
	 * 
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	 
	 /**
	  * Compare this user to another to dertermine if they are the same
	  * 
	  * @param UserInterface $user
	  * @param boolean true if equal, false otherwise
	  */
	 public function equals(UserInterface $user)
	 {
	 	return md5($this->getUsername()) == md5($user->getUsername());
	 }

	/**
	 * Erases the user credentials
	 */
	public function eraseCredentials()
	{
		
	}

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
}