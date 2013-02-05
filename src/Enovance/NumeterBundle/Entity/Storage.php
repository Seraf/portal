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
     * @ORM\OneToMany(targetEntity="Host", mappedBy="storageID", cascade={"all"})
     */
    private $hosts;


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
}