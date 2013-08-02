<?php
/**
 * User: nikk
 * Date: 7/31/13
 * Time: 10:55 AM
 */

namespace Ps\AppBundle\Classes;

class MysqlDateTime extends \DateTime
{
    const MYSQL_FORMAT = 'Y-m-d H:i:s';

    public function __toString()
    {
        return $this->format(self::MYSQL_FORMAT);
    }
}