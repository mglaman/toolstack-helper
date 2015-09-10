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

    public function testInspect()
    {
        $stack = Toolstack::inspect($this->dir);
        $this->assertEquals(Stacks\WordPress::TYPE, $stack->type(), 'Directory is a WordPress project');
    }
}
