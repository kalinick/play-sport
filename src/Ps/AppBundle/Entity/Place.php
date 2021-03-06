<?php
/**
 * User: nikk
 * Date: 6/13/13
 * Time: 4:29 PM
 */

namespace Ps\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="place")
 * @ORM\HasLifecycleCallbacks
 */
class Place
{
    use UploadFileTrait;

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
     * @ORM\ManyToOne(targetEntity="City", inversedBy="places")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="place")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="RegularEvent", mappedBy="place")
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
     * @return Place
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
     * Set city
     *
     * @param City $city
     * @return Place
     */
    public function setCity(City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set image path
     *
     * @param string $imageFilename
     * @return Place
     */
    public function setImageFilename($imageFilename)
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    /**
     * Get image filename
     *
     * @return string
     */
    public function getImageFilename()
    {
        return $this->imageFilename;
    }

    /**
     * @return mixed
     */
    protected function &getFilenameField()
    {
        return $this->imageFilename;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadFile()
    {
        $this->_uploadFile();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeFile()
    {
        $this->_removeFile($this->imageFilename);
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
     * @return Place
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
     * @return Place
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