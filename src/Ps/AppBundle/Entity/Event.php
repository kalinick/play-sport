<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 4:20 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ps\AppBundle\Repository\EventRepository")
 * @ORM\Table(name="event")
 */
class Event
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="events")
     * @ORM\JoinColumn(name="organizer_id", referencedColumnName="id", nullable=false)
     */
    private $organizer;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateEnd;

    /**
     * @ORM\OneToMany(targetEntity="EventMember", mappedBy="event")
     */
    private $eventMembers;

    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="events")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    private $place;

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
     * @return Event
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
     * Set dateStart
     *
     * @param integer $dateStart
     * @return Event
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    
        return $this;
    }

    /**
     * Get dateStart
     *
     * @return integer
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param integer $dateEnd
     * @return Event
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    
        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return integer
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set organizer
     *
     * @param \Ps\AppBundle\Entity\User $organizer
     * @return Event
     */
    public function setOrganizer(\Ps\AppBundle\Entity\User $organizer = null)
    {
        $this->organizer = $organizer;
    
        return $this;
    }

    /**
     * Get organizer
     *
     * @return \Ps\AppBundle\Entity\User 
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventMembers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add eventMembers
     *
     * @param \Ps\AppBundle\Entity\EventMember $eventMembers
     * @return Event
     */
    public function addEventMember(\Ps\AppBundle\Entity\EventMember $eventMembers)
    {
        $this->eventMembers[] = $eventMembers;
    
        return $this;
    }

    /**
     * Remove eventMembers
     *
     * @param \Ps\AppBundle\Entity\EventMember $eventMembers
     */
    public function removeEventMember(\Ps\AppBundle\Entity\EventMember $eventMembers)
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

    /**
     * Set place
     *
     * @param \Ps\AppBundle\Entity\Place $place
     * @return Event
     */
    public function setPlace(\Ps\AppBundle\Entity\Place $place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return \Ps\AppBundle\Entity\Place 
     */
    public function getPlace()
    {
        return $this->place;
    }
}