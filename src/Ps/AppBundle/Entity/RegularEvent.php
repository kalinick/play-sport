<?php
/**
 * User: nikk
 * Date: 6/19/13
 * Time: 4:29 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ps\AppBundle\Repository\RegularEventRepository")
 * @ORM\Table(name="regular_event")
 */
class RegularEvent
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="organizer_id", referencedColumnName="id", nullable=false)
     */
    private $organizer;

    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id", nullable=false)
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="EventPrivacy", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="privacy_id", referencedColumnName="id", nullable=false)
     */
    private $privacy;

    /**
     * @ORM\ManyToOne(targetEntity="Sport", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="sport_id", referencedColumnName="id", nullable=false)
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     */
    private $dayStart;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     */
    private $timeStart;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     */
    private $dayEnd;

    /**
     * @ORM\Column(type="string", length=5, nullable=false)
     */
    private $timeEnd;

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
     * @return RegularEvent
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
     * Set dayStart
     *
     * @param string $dayStart
     * @return RegularEvent
     */
    public function setDayStart($dayStart)
    {
        $this->dayStart = $dayStart;
    
        return $this;
    }

    /**
     * Get dayStart
     *
     * @return string 
     */
    public function getDayStart()
    {
        return $this->dayStart;
    }

    /**
     * Set timeStart
     *
     * @param string $timeStart
     * @return RegularEvent
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    
        return $this;
    }

    /**
     * Get timeStart
     *
     * @return string 
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set dayEnd
     *
     * @param string $dayEnd
     * @return RegularEvent
     */
    public function setDayEnd($dayEnd)
    {
        $this->dayEnd = $dayEnd;
    
        return $this;
    }

    /**
     * Get dayEnd
     *
     * @return string 
     */
    public function getDayEnd()
    {
        return $this->dayEnd;
    }

    /**
     * Set timeEnd
     *
     * @param string $timeEnd
     * @return RegularEvent
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;
    
        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return string 
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set organizer
     *
     * @param User $organizer
     * @return RegularEvent
     */
    public function setOrganizer(User $organizer)
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
     * Set place
     *
     * @param Place $place
     * @return RegularEvent
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
     * @return RegularEvent
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
     * @return RegularEvent
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
     * @return RegularEvent
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