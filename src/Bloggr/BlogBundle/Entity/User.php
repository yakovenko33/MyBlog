<?php

namespace Bloggr\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Bloggr\BlogBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=40)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string")
     *
     * @@ORM\Assert\NotBlank(message="Please, upload the you photo as a jpg file.")
     * @@ORM\Assert\File( maxSize = "1024k", mimeTypes={ "application/jpg" })
     */
    private $photo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="laast_login_at", type="datetime")
     */
    private $laastLoginAt;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="users_role",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */


    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_name", type="string", length=80)
     */
    private $photoName;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->salt = md5(uniqid());
        $this->laastLoginAt = new \DateTime();
        $this->role = new ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set laastLoginAt
     *
     * @param \DateTime $laastLoginAt
     * @return User
     */
    public function setLaastLoginAt($laastLoginAt)
    {
        $this->laastLoginAt = $laastLoginAt;

        return $this;
    }

    /**
     * Get laastLoginAt
     *
     * @return \DateTime 
     */
    public function getLaastLoginAt()
    {
        return $this->laastLoginAt;
    }

    public function addRole(Role $role){
        $this->role->add($role);
        return  $this;
    }

    public function getRoles()
    {
        return $this->role->toArray();
    }

    public function eraseCredentials()
    {
        ;
    }

    public function setPhotoName($photoName)
    {
        $this->photoName =  $photoName;

        return $this;
    }

    public function getPhotoName()
    {
        return $this->photoName;
    }
}
