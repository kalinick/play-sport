<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 4:54 PM
 */

namespace Ps\FrontBundle\Tests\Controller;

use Ps\AppBundle\Model\SportModel;
use Ps\AppBundle\Tests\BaseTestCase;
use Ps\AppBundle\Controller\GetContainerTrait;

class AbstractEventsTest extends BaseTestCase
{
    use GetContainerTrait;

    public function testEventsCreation()
    {
        $this->refreshDb();

        $this->runConsole('ps:app:create-regular-events', ['--day' => 'mon']);
        $events = $this->getEventManager()->getActualEvents(SportModel::FOOTBALL);
        $this->assertEquals(count($events), 3);
    }
}