<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:20 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_member")
 */
class EventMember
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserFriend")
     * @ORM\JoinColumn(name="user_friend_id", referencedColumnName="id")
     */
    protected $userFriend;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="eventMembers")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     */
    protected $event;

    /**
     * @ORM\Column(type="integer")
     */
    protected $participate;

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
     * Set user
     *
     * @param \Ps\AppBundle\Entity\User $user
     * @return EventMember
     */
    public function setUser(\Ps\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Ps\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \Ps\AppBundle\Entity\Event $event
     * @return EventMember
     */
    public function setEvent(\Ps\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return \Ps\AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set participate
     *
     * @param integer $participate
     * @return EventMember
     */
    public function setParticipate($participate)
    {
        $this->participate = $participate;
    
        return $this;
    }

    /**
     * Get participate
     *
     * @return integer 
     */
    public function getParticipate()
    {
        return $this->participate;
    }

    /**
     * Set userFriend
     *
     * @param \Ps\AppBundle\Entity\UserFriend $userFriend
     * @return EventMember
     */
    public function setUserFriend(\Ps\AppBundle\Entity\UserFriend $userFriend = null)
    {
        $this->userFriend = $userFriend;
    
        return $this;
    }

    /**
     * Get userFriend
     *
     * @return \Ps\AppBundle\Entity\UserFriend 
     */
    public function getUserFriend()
    {
        return $this->userFriend;
    }
}