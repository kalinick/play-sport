<?php
/**
 * User: nikk
 * Date: 6/14/13
 * Time: 3:11 PM
 */

namespace Ps\SlavsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ps\SlavsBundle\Repository\SlavsRepository")
 * @ORM\Table(name="slavs")
 */
class Slavs
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
    private $player;
    /**
     * @ORM\Column(type="integer")
     */
    private $number;
    /**
     * @ORM\Column(type="integer", options={"default"="0"})
     */
    private $games;
    /**
     * @ORM\Column(type="integer", options={"default"="0"})
     */
    private $substitute;
    /**
     * @ORM\Column(type="integer", options={"default"="0"})
     */
    private $goals;

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
     * Set player
     *
     * @param string $player
     *
     * @return Slavs
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return string 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set games
     *
     * @param integer $games
     *
     * @return Slavs
     */
    public function setGames($games)
    {
        $this->games = $games;

        return $this;
    }

    /**
     * Get games
     *
     * @return integer 
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Set substitute
     *
     * @param integer $substitute
     *
     * @return Slavs
     */
    public function setSubstitute($substitute)
    {
        $this->substitute = $substitute;

        return $this;
    }

    /**
     * Get substitute
     *
     * @return integer 
     */
    public function getSubstitute()
    {
        return $this->substitute;
    }

    /**
     * Set goals
     *
     * @param integer $goals
     *
     * @return Slavs
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * Get goals
     *
     * @return integer 
     */
    public function getGoals()
    {
        return $this->goals;
    }
}
