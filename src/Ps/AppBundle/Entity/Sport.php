<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 3:48 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sport")
 */
class Sport
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
     * @ORM\OneToMany(targetEntity="Event", mappedBy="sport")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="RegularEvent", mappedBy="sport")
     */
    private $regularEvents;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->regularEvents = new ArrayCollection();
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
     * @return Sport
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
     * Add events
     *
     * @param Event $events
     * @return Sport
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
     * @return Sport
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }
}