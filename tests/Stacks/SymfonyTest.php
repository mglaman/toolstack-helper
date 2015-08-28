<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 4:10 AM
 */

namespace mglaman\Toolstack\Tests\Stacks;


use mglaman\Toolstack\Toolstack;
use mglaman\Toolstack\Stacks;

class SymfonyTest extends \PHPUnit_Framework_TestCase
{
    protected $dir = 'tests/resources/symfony';

    /**
     * @var Toolstack
     */
    protected $toolsstack;

    protected function setUp()
    {
        parent::setUp();
        $this->toolsstack = Toolstack::instance();
    }

    /**
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\Symfony::inspect()
     * @covers \mglaman\Toolstack\Stacks\Symfony::type()
     */
    public function testInspect()
    {
        $type = $this->toolsstack->inspect($this->dir);
        $this->assertEquals(Stacks\Symfony::TYPE, $type, 'Directory is a Symfony project');
    }

    public function testType()
    {
        /** @var Stacks\Symfony $stack */
        $stack = $this->toolsstack->getStackByType(Stacks\Symfony::TYPE);
        $this->assertEquals($stack->type(), Stacks\Symfony::TYPE);
    }
}
