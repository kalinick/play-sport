<?php
/**
 * User: nikk
 * Date: 4/14/14
 * Time: 3:50 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="event_state")
 */
class EventState
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
     * @ORM\OneToMany(targetEntity="RegularEvent", mappedBy="state")
     */
    private $regularEvents;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regularEvents = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return EventState
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param RegularEvent $regularEvents
     *
     * @return EventState
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
     * @return RegularEvent[]
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