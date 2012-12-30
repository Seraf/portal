<?php

namespace Enovance\LogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 */
class Test
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $test;

    /**
     * @ORM\OneToMany(targetEntity="Enovance\InfrastructureBundle\Entity\Host", mappedBy="test", cascade={"all"})
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
     * Set test
     *
     * @param string $test
     * @return Test
     */
    public function setTest($test)
    {
        $this->test = $test;
    
        return $this;
    }

    /**
     * Get test
     *
     * @return string 
     */
    public function getTest()
    {
        return $this->test;
    }
}
