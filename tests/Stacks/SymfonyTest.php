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
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\Symfony::inspect()
     * @covers \mglaman\Toolstack\Stacks\Symfony::type()
     */
    public function testInspect()
    {
        $stack = Toolstack::inspect($this->dir);
        $this->assertEquals(Stacks\Symfony::TYPE, $stack->type(), 'Directory is a Symfony project');
    }

    public function testType()
    {
        /** @var Stacks\Symfony $stack */
        $stack = Toolstack::getStackByType(Stacks\Symfony::TYPE);
        $this->assertEquals($stack->type(), Stacks\Symfony::TYPE);
    }
}
