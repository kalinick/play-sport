<?php
/**
 * User: nikk
 * Date: 7/31/13
 * Time: 11:30 AM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_privacy")
 */
class EventPrivacy
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
     * @ORM\OneToMany(targetEntity="Event", mappedBy="privacy")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="RegularEvent", mappedBy="privacy")
     */
    private $regularEvents;

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
     * @return EventPrivacy
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
     * @return mixed
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->regularEvents = new ArrayCollection();
    }
    
    /**
     * Add events
     *
     * @param Event $events
     * @return EventPrivacy
     */
    public function addEvent(Event $events)
    {
        $this->events[] = $events;
    
        return $this;
    }

    /**
     * Remove events
     *
     * @param Event $events
     */
    public function removeEvent(Event $events)
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
     * Add regularEvents
     *
     * @param RegularEvent $regularEvents
     * @return EventPrivacy
     */
    public function addRegularEvent(RegularEvent $regularEvents)
    {
        $this->regularEvents[] = $regularEvents;
    
        return $this;
    }

    /**
     * Remove regularEvents
     *
     * @param RegularEvent $regularEvents
     */
    public function removeRegularEvent(RegularEvent $regularEvents)
    {
        $this->regularEvents->removeElement($regularEvents);
    }

    /**
     * Get regularEvents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegularEvents()
    {
        return $this->regularEvents;
    }
}