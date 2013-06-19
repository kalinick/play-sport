<?php
/**
 * User: nikk
 * Date: 6/19/13
 * Time: 4:29 PM
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
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="regularEvents")
     * @ORM\JoinColumn(name="organizer_id", referencedColumnName="id", nullable=false)
     */
    protected $organizer;

    /**
     * @ORM\Column(type="integer")
     */
    protected $dateStart;

    /**
     * @ORM\Column(type="integer")
     */
    protected $dateEnd;
}