<?php
/**
 * User: nikk
 * Date: 7/16/13
 * Time: 11:00 AM
 */

namespace Ps\FrontBundle\Twig;

use Ps\AppBundle\Entity\User;

class GetUserNameExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('getUserName', array($this, 'getUserName')),
        );
    }

    /**
     * @param User $oUser
     * @return string
     */
    public function getUserName(User $oUser)
    {
        $name = $oUser->getFirstName() . ' ' . $oUser->getLastName();
        if (strlen(trim($name)) > 0) {
            return $name;
        }

        return $oUser->getUsername();
    }

    public function getName()
    {
        return 'ps_get_user_name_extension';
    }
}