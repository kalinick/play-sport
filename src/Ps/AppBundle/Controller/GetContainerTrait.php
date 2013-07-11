<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 4:51 PM
 */

namespace Ps\AppBundle\Controller;

use Ps\AppBundle\Model;

trait GetContainerTrait
{
    /**
     * @return \Symfony\Component\Security\Core\SecurityContext
     */
    protected function getSecurityContext()
    {
        return $this->get('security.context');
    }

    /**
     * @return Model\EventManager
     */
    protected function getEventManager()
    {
        return $this->get('ps_app.event_manager');
    }

    /**
     * @return Model\RegularEventManager
     */
    protected function getRegularEventManager()
    {
        return $this->get('ps_app.regular_event_manager');
    }

    /**
     * @return Model\EventMemberManager
     */
    protected function getEventMemberManager()
    {
        return $this->get('ps_app.event_member_manager');
    }

    /**
     * @return Model\UserFriendManager
     */
    protected function getUserFriendManager()
    {
        return $this->get('ps_app.user_friend_manager');
    }

    protected abstract function get($id);
}