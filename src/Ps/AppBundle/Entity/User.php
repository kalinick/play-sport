<?php
/**
 * User: nikk
 * Date: 6/13/13
 * Time: 5:00 PM
 */

namespace Ps\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="City", inversedBy="users")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    public function __construct()
    {
        parent::__construct();
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
     * @param \Ps\AppBundle\Entity\City $city
     * @return User
     */
    public function setCity(\Ps\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Ps\AppBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}