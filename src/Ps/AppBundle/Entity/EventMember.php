<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 5:20 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ps\AppBundle\Repository\EventMemberRepository")
 * @ORM\Table(name="event_member")
 */
class EventMember
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="UserFriend")
     * @ORM\JoinColumn(name="user_friend_id", referencedColumnName="id")
     */
    private $userFriend;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="eventMembers")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id", nullable=false)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="EventMemberParticipation", inversedBy="eventMembers")
     * @ORM\JoinColumn(name="participation_id", referencedColumnName="id", nullable=false)
     */
    private $participation;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

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
     * @param User $user
     * @return EventMember
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param Event $event
     * @return EventMember
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set userFriend
     *
     * @param UserFriend $userFriend
     * @return EventMember
     */
    public function setUserFriend(UserFriend $userFriend = null)
    {
        $this->userFriend = $userFriend;
    
        return $this;
    }

    /**
     * Get userFriend
     *
     * @return UserFriend
     */
    public function getUserFriend()
    {
        return $this->userFriend;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EventMember
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
     * @return string
     */
    public function __toString()
    {
        if ($this->getUser()) {
            $name = $this->getUser()->getFirstName() . ' ' . $this->getUser()->getLastName();
            if (strlen(trim($name)) > 0) {
                return $name;
            }

            return $this->getUser()->getUsername();
        } else {
            if ($this->getUserFriend()) {
                return $this->getUserFriend()->getTitle();
            } else {
                return $this->title;
            }
        }
    }

    /**
     * Set participation
     *
     * @param EventMemberParticipation $participation
     * @return EventMember
     */
    public function setParticipation(EventMemberParticipation $participation)
    {
        $this->participation = $participation;
    
        return $this;
    }

    /**
     * Get participation
     *
     * @return EventMemberParticipation
     */
    public function getParticipation()
    {
        return $this->participation;
    }
}