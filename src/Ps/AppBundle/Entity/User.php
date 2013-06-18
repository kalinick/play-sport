<?php
/**
 * User: nikk
 * Date: 6/13/13
 * Time: 5:00 PM
 */

namespace Ps\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    protected $city;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="organizer")
     */
    protected $events;

    /**
     * @ORM\OneToMany(targetEntity="UserFriend", mappedBy="user")
     */
    protected $userFriends;

    public function __construct()
    {
        parent::__construct();

        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->userFriends = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set city
     *
     * @param \Ps\AppBundle\Entity\City $city
     * @return User
     */
    public function setCity(\Ps\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Ps\AppBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add events
     *
     * @param \Ps\AppBundle\Entity\Event $events
     * @return User
     */
    public function addEvent(\Ps\AppBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    
        return $this;
    }

    /**
     * Remove events
     *
     * @param \Ps\AppBundle\Entity\Event $events
     */
    public function removeEvent(\Ps\AppBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add userFriends
     *
     * @param \Ps\AppBundle\Entity\UserFriend $userFriends
     * @return User
     */
    public function addUserFriend(\Ps\AppBundle\Entity\UserFriend $userFriends)
    {
        $this->userFriends[] = $userFriends;
    
        return $this;
    }

    /**
     * Remove userFriends
     *
     * @param \Ps\AppBundle\Entity\UserFriend $userFriends
     */
    public function removeUserFriend(\Ps\AppBundle\Entity\UserFriend $userFriends)
    {
        $this->userFriends->removeElement($userFriends);
    }

    /**
     * Get userFriends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserFriends()
    {
        return $this->userFriends;
    }
}