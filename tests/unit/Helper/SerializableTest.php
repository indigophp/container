<?php

namespace Indigo\Container\Helper;

use Indigo\Container\AbstractTest;

/**
 * Tests for Serializable trait
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Serializable
 */
class SerialiazableTest extends AbstractTest
{
    public function _before()
    {
        $this->container = new \HelperContainer(array(
            'key' => 'value'
        ));
    }

    /**
     * @covers ::serialize
     * @covers ::unserialize
     * @group  Container
     */
    public function testSerialize()
    {
        $this->assertEquals($this->container, unserialize(serialize($this->container)));
    }
}
