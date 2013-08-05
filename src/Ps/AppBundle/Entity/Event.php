<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 4:20 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="events")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="EventPrivacy", inversedBy="events")
     * @ORM\JoinColumn(name="privacy_id", referencedColumnName="id", nullable=false)
     */
    private $privacy;

    /**
     * @ORM\ManyToOne(targetEntity="Sport", inversedBy="events")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id", nullable=false)
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity="EventMember", mappedBy="event")
     */
    private $eventMembers;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $memberLimit;

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
     * @param \DateTime $dateStart
     * @return Event
     */
    public function setDateStart(\DateTime $dateStart)
    {
        $this->dateStart = $dateStart;
    
        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Event
     */
    public function setDateEnd(\DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;
    
        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set organizer
     *
     * @param User $organizer
     * @return Event
     */
    public function setOrganizer(User $organizer = null)
    {
        $this->organizer = $organizer;
    
        return $this;
    }

    /**
     * Get organizer
     *
     * @return User
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
        $this->eventMembers = new ArrayCollection();
    }
    
    /**
     * Add eventMembers
     *
     * @param EventMember $eventMembers
     * @return Event
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
     * @return \Doctrine\Common\Collections\Collection|EventMember[]
     */
    public function getEventMembers()
    {
        return $this->eventMembers;
    }

    /**
     * Set place
     *
     * @param Place $place
     * @return Event
     */
    public function setPlace(Place $place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set memberLimit
     *
     * @param integer $memberLimit
     * @return Event
     */
    public function setMemberLimit($memberLimit)
    {
        $this->memberLimit = $memberLimit;
    
        return $this;
    }

    /**
     * Get memberLimit
     *
     * @return integer 
     */
    public function getMemberLimit()
    {
        return $this->memberLimit;
    }

    /**
     * Set privacy
     *
     * @param EventPrivacy $privacy
     * @return Event
     */
    public function setPrivacy(EventPrivacy $privacy)
    {
        $this->privacy = $privacy;
    
        return $this;
    }

    /**
     * Get privacy
     *
     * @return EventPrivacy
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * Set sport
     *
     * @param Sport $sport
     * @return Event
     */
    public function setSport(Sport $sport)
    {
        $this->sport = $sport;
    
        return $this;
    }

    /**
     * Get sport
     *
     * @return Sport
     */
    public function getSport()
    {
        return $this->sport;
    }
}