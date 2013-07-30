<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 3:11 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="city")
     */
    private $places;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="city")
     */
    private $users;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return City
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add places
     *
     * @param \Ps\AppBundle\Entity\Place $places
     * @return City
     */
    public function addPlace(\Ps\AppBundle\Entity\Place $places)
    {
        $this->places[] = $places;
    
        return $this;
    }

    /**
     * Remove places
     *
     * @param \Ps\AppBundle\Entity\Place $places
     */
    public function removePlace(\Ps\AppBundle\Entity\Place $places)
    {
        $this->places->removeElement($places);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Add users
     *
     * @param \Ps\AppBundle\Entity\User $users
     * @return City
     */
    public function addUser(\Ps\AppBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Ps\AppBundle\Entity\User $users
     */
    public function removeUser(\Ps\AppBundle\Entity\User $users)
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}