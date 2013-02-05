<?php

namespace Enovance\NumeterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="numeter_hosts")
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
    private $hostID;

    /**
     * @ORM\ManyToOne(targetEntity="Storage", inversedBy="hosts", cascade={"all"})
     */
    private $storageID;


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
     * Set hostID
     *
     * @param string $hostID
     * @return Host
     */
    public function setHostID($hostID)
    {
        $this->hostID = $hostID;
    
        return $this;
    }

    /**
     * Get hostID
     *
     * @return string 
     */
    public function getHostID()
    {
        return $this->hostID;
    }

    /**
     * Set storageID
     *
     * @param string $storageID
     * @return Host
     */
    public function setStorageID($storageID)
    {
        $this->storageID = $storageID;
    
        return $this;
    }

    /**
     * Get storageID
     *
     * @return string 
     */
    public function getStorageID()
    {
        return $this->storageID;
    }
}