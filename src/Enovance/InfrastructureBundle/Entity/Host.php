<?php

namespace Enovance\InfrastructureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Host
 */
class Host
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $addr;

    /**
     * @var string
     */
    private $NumeterUID;

    /**
     * @var \Enovance\NumeterBundle\Entity\Storage
     */
    private $storage;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $companies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->companies = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Host
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
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

    /**
     * Set addr
     *
     * @param string $addr
     * @return Host
     */
    public function setAddr($addr)
    {
        $this->addr = $addr;
    
        return $this;
    }

    /**
     * Get addr
     *
     * @return string 
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * Set NumeterUID
     *
     * @param string $numeterUID
     * @return Host
     */
    public function setNumeterUID($numeterUID)
    {
        $this->NumeterUID = $numeterUID;
    
        return $this;
    }

    /**
     * Get NumeterUID
     *
     * @return string 
     */
    public function getNumeterUID()
    {
        return $this->NumeterUID;
    }

    /**
     * Set storage
     *
     * @param \Enovance\NumeterBundle\Entity\Storage $storage
     * @return Host
     */
    public function setStorage(\Enovance\NumeterBundle\Entity\Storage $storage = null)
    {
        $this->storage = $storage;
    
        return $this;
    }

    /**
     * Get storage
     *
     * @return \Enovance\NumeterBundle\Entity\Storage 
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Add companies
     *
     * @param \Enovance\UserBundle\Entity\Company $companies
     * @return Host
     */
    public function addCompanie(\Enovance\UserBundle\Entity\Company $companies)
    {
        $this->companies[] = $companies;
    
        return $this;
    }

    /**
     * Remove companies
     *
     * @param \Enovance\UserBundle\Entity\Company $companies
     */
    public function removeCompanie(\Enovance\UserBundle\Entity\Company $companies)
    {
        $this->companies->removeElement($companies);
    }

    /**
     * Get companies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompanies()
    {
        return $this->companies;
    }
}
