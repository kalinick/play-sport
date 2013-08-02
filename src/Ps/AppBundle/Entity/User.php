<?php
/**
 * User: nikk
 * Date: 6/13/13
 * Time: 5:00 PM
 */

namespace Ps\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=63, nullable=true)
     * @Assert\Length(
     *      min = "2",
     *      max = "63",
     *      minMessage = "entity.user.first_name.short",
     *      maxMessage = "entity.user.first_name.long",
     *      groups={"Registration", "Profile"}
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=63, nullable=true)
     * @Assert\Length(
     *      min = "2",
     *      max = "63",
     *      minMessage = "entity.user.last_name.short",
     *      maxMessage = "entity.user.last_name.long",
     *      groups={"Registration", "Profile"}
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     * @Assert\Regex(
     *     pattern="/^\d{10,15}$/",
     *     message="entity.user.phone.invalid",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="organizer")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="UserFriend", mappedBy="user")
     */
    private $userFriends;

    public function __construct()
    {
        parent::__construct();

        $this->events = new ArrayCollection();
        $this->userFriends = new ArrayCollection();
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
     * Set city
     *
     * @param City $city
     * @return User
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
     * Add events
     *
     * @param Event $events
     * @return User
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
     * Add userFriends
     *
     * @param UserFriend $userFriends
     * @return User
     */
    public function addUserFriend(UserFriend $userFriends)
    {
        $this->userFriends[] = $userFriends;
    
        return $this;
    }

    /**
     * Remove userFriends
     *
     * @param UserFriend $userFriends
     */
    public function removeUserFriend(UserFriend $userFriends)
    {
        $this->userFriends->removeElement($userFriends);
    }

    /**
     * Get userFriends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserFriends()
    {
        return $this->userFriends;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $name = $this->getFirstName() . ' ' . $this->getLastName();
        if (strlen(trim($name)) > 0) {
            return $name;
        }

        return $this->getUsername();
    }
}