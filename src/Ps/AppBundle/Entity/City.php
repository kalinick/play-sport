<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 3:11 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
        $this->places = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @param Place $places
     * @return City
     */
    public function addPlace(Place $places)
    {
        $this->places[] = $places;
    
        return $this;
    }

    /**
     * Remove places
     *
     * @param Place $places
     */
    public function removePlace(Place $places)
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
     * @param User $users
     * @return City
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param User $users
     */
    public function removeUser(User $users)
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