<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 5:36 PM
 */

namespace Ps\AppBundle\Model;

class EventMemberModel
{
    const PARTICIPATE_NO = 0;
    const PARTICIPATE_YES = 1;
    const PARTICIPATE_APPROVED = 2;

    static public function getParticipateList()
    {
        return [self::PARTICIPATE_NO, self::PARTICIPATE_YES, self::PARTICIPATE_APPROVED];
    }
}