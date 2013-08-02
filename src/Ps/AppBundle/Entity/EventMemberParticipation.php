<?php
/**
 * User: nikk
 * Date: 8/1/13
 * Time: 10:55 AM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Ps\AppBundle\Repository\EventMemberParticipationRepository")
 * @ORM\Table(name="event_member_participation")
 */
class EventMemberParticipation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="EventMember", mappedBy="participation")
     */
    private $eventMembers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventMembers = new ArrayCollection();
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
     * @return EventMemberParticipation
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
     * Add eventMembers
     *
     * @param EventMember $eventMembers
     * @return EventMemberParticipation
     */
    public function addEventMember(EventMember $eventMembers)
    {
        $this->eventMembers[] = $eventMembers;
    
        return $this;
    }

    /**
     * Remove eventMembers
     *
     * @param EventMember $eventMembers
     */
    public function removeEventMember(EventMember $eventMembers)
    {
        $this->eventMembers->removeElement($eventMembers);
    }

    /**
     * Get eventMembers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventMembers()
    {
        return $this->eventMembers;
    }
}