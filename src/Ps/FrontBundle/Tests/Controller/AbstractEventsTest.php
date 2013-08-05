<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 4:54 PM
 */

namespace Ps\FrontBundle\Tests\Controller;

use Ps\AppBundle\Tests\BaseTestCase;

class AbstractEventsTest extends BaseTestCase
{
    public function setUp()
    {
        for($i = 0; $i< 10; $i++) {
            parent::setUp();
        }
    }

    public function testA()
    {
        $this->assertEquals(1, 1);
    }
}