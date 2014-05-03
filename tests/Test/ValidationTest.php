<?php

namespace Indigo\Container\Test;

use Indigo\Container\Validation;
use Fuel\Validation\ContainerValidator as Validator;
use Fuel\Common\DataContainer;

/**
 * Tests for Validation container
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Validation
 */
class ValidationTest extends AbstractTest
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator;

        $this->container = new Validation($this->validator);

        $this->populateValidator($this->validator);
    }

    public function populateValidator(Validator $validator)
    {
        $validator->addField('email', 'Email')
            ->required()
            ->email();

        $validator->addField('name', 'Name')
            ->minLength(1);
    }

    /**
     * @covers ::__construct
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Validation(
            $this->validator,
            array(
                'email' => 'user@example.com'
            )
        );
    }

    /**
     * @covers ::__construct
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testConstructFailure()
    {
        $container = new Validation(
            $this->validator,
            array(
                'email' => 'user@example'
            )
        );
    }

    /**
     * @covers ::set
     * @group  Container
     */
    public function testSet()
    {
        $this->container->set('name', 'test');

        $this->assertEquals('test', $this->container->get('name'));
    }

    /**
     * @covers ::set
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testSetFailure()
    {
        $this->container->set('email', 123);
    }

    /**
     * @covers ::merge
     * @group  Container
     */
    public function testMerge()
    {
        $this->container->merge(array('name' => 'test'));

        $this->assertEquals('test', $this->container->get('name'));
    }

    /**
     * @covers ::merge
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testMergeFailure()
    {
        $this->container->merge(
            array('email' => 123),
            new DataContainer(array('email' => 'user2@example'))
        );
    }
}
