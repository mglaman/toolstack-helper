<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 2:19 AM
 */

namespace mglaman\Toolstack\Tests\Stacks;

use mglaman\Toolstack\Stacks;
use mglaman\Toolstack\Toolstack;

class WordPressTest extends \PHPUnit_Framework_TestCase
{
    protected $dir = 'tests/resources/wordpress';

    /**
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\WordPress::inspect()
     * @covers \mglaman\Toolstack\Stacks\WordPress::type()
     */
    public function testInspect()
    {
        $type = Toolstack::inspect($this->dir);
        $this->assertEquals(Stacks\WordPress::TYPE, $type, 'Directory is a WordPress project');
    }

    public function testType()
    {
        /** @var Stacks\WordPress $stack */
        $stack = Toolstack::getStackByType(Stacks\WordPress::TYPE);
        $this->assertEquals($stack->type(), Stacks\WordPress::TYPE);
    }
}
