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
    private $hostUID;

    /**
     * @var \Enovance\NumeterBundle\Entity\Storage
     */
    private $storage;


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
     * Set hostUID
     *
     * @param string $hostUID
     * @return Host
     */
    public function setHostUID($hostUID)
    {
        $this->hostUID = $hostUID;
    
        return $this;
    }

    /**
     * Get hostUID
     *
     * @return string 
     */
    public function getHostUID()
    {
        return $this->hostUID;
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
}
