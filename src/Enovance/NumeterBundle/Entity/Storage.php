<?php

namespace Enovance\NumeterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Storage
 */
class Storage
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
     * @var integer
     */
    private $port;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $hosts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hosts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Storage
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
     * @return Storage
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
     * Set port
     *
     * @param integer $port
     * @return Storage
     */
    public function setPort($port)
    {
        $this->port = $port;
    
        return $this;
    }

    /**
     * Get port
     *
     * @return integer 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Add hosts
     *
     * @param \Enovance\InfrastructureBundle\Entity\Host $hosts
     * @return Storage
     */
    public function addHost(\Enovance\InfrastructureBundle\Entity\Host $hosts)
    {
        $this->hosts[] = $hosts;
    
        return $this;
    }

    /**
     * Remove hosts
     *
     * @param \Enovance\InfrastructureBundle\Entity\Host $hosts
     */
    public function removeHost(\Enovance\InfrastructureBundle\Entity\Host $hosts)
    {
        $this->hosts->removeElement($hosts);
    }

    /**
     * Get hosts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHosts()
    {
        return $this->hosts;
    }
}
