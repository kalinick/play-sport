<?php
/**
 * User: nikk
 * Date: 7/12/13
 * Time: 4:28 PM
 */

namespace Ps\AppBundle\Classes;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\ParameterBag;

class CookiesAnonymousEventMember
{
    private $eventId;

    /**
     * @param string $eventId
     */
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @param ParameterBag $cookies
     * @return int|null
     */
    public function get($cookies)
    {
        return $cookies->get($this->getKey());
    }

    /**
     * @param int $id
     * @return Cookie
     */
    public function createCookies($id)
    {
        return new Cookie($this->getKey(), $id);
    }

    /**
     * Create key in cookie
     * @return string
     */
    private function getKey()
    {
        return 'event_' . $this->eventId . '_member';
    }
}