<?php

namespace Enovance\UserBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var \Enovance\UserBundle\Entity\Company
     */
    private $company;

    public function __construct()
    {
        parent::__construct();
        $this->groups = new ArrayCollection();
        $this->salt = md5(uniqid(null, true));
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set company
     *
     * @param \Enovance\UserBundle\Entity\Company $company
     * @return User
     */
    public function setCompany(\Enovance\UserBundle\Entity\Company $company = null)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \Enovance\UserBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;



    /**
     * @ORM\Column(name="avatar", type="string", length=64, nullable=true)
     */
    private $avatar;

    /**
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar ? $this->avatar : 'unknown_user.png';
    }

    public function getAbsoluteAvatarPath()
    {
        return null === $this->avatar ? null : $this->getAvatarRootDir() . '/' . $this->avatar;
    }

    public function getAvatarWebPath()
    {
        return $this->getAvatarDir() . '/' . $this->getAvatar();
    }

    protected function getAvatarRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
	return __DIR__.'/../../../../web/'.$this->getAvatarDir();
    }

    protected function getAvatarDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/avatars';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (NULL !== $this->file && $this->avatar === NULL)
            $this->avatar = uniqid() . '.' . $this->file->guessExtension();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadAvatar()
    {
        if (null === $this->file)
            return;

        $this->file->move($this->getAvatarRootDir(), $this->avatar);

        unset($this->file);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsoluteAvatarPath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filenameForRemove)
        {
            unlink($this->filenameForRemove);
        }
    }
}
