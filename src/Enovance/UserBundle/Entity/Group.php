<?php

namespace Enovance\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $permissions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct($name, $roles=array())
    {
        parent::__construct($name, $roles);
        $this->permissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add permissions
     *
     * @param \Enovance\UserBundle\Entity\Permission $permissions
     * @return Group
     */
    public function addPermission(\Enovance\UserBundle\Entity\Permission $permissions)
    {
        $this->permissions[] = $permissions;
    
        return $this;
    }

    /**
     * Remove permissions
     *
     * @param \Enovance\UserBundle\Entity\Permission $permissions
     */
    public function removePermission(\Enovance\UserBundle\Entity\Permission $permissions)
    {
        $this->permissions->removeElement($permissions);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Add users
     *
     * @param \Enovance\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Enovance\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Enovance\UserBundle\Entity\User $users
     */
    public function removeUser(\Enovance\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __toString()
    {
        return $this->name;
    }

}
