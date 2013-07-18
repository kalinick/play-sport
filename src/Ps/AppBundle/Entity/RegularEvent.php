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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="organizer_id", referencedColumnName="id", nullable=false)
     */
    private $organizer;

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
     * @param \Ps\AppBundle\Entity\User $organizer
     * @return RegularEvent
     */
    public function setOrganizer(\Ps\AppBundle\Entity\User $organizer)
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
}