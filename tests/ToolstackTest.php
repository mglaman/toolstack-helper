<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 12:58 AM
 */

namespace mglaman\Toolstack\Tests;

use mglaman\Toolstack\Toolstack;
use mglaman\Toolstack\Stacks;

/**
 * Class ToolstackTest
 *
 * @coversDefaultClass \mglaman\Toolstack\Toolstack
 */
class ToolstackTest extends \PHPUnit_Framework_TestCase
{

    public function testGetStacks()
    {
        $stacks = Toolstack::getStacks();
        $this->assertNotEmpty($stacks, 'Toolstack returned array of stacks');
    }

    public function testGetStackByType()
    {
        // @todo this should probably be mocked for proper unit testing.
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $this->assertInstanceOf('\mglaman\Toolstack\Stacks\StacksInterface', $stack);

        $stack = Toolstack::getStackByType('SomeRandomey');
        $this->assertNull($stack->type());
    }

    public function testGetStackByDir()
    {
        $stack = Toolstack::getStackByDir('tests/resources/composer');
        $this->assertInstanceOf('\mglaman\Toolstack\Stacks\StacksInterface', $stack);

        $stack = Toolstack::getStackByDir('tests/resources/empty');
        $this->assertNull($stack->type());
    }

    /**
     * @expectedException \Symfony\Component\Filesystem\Exception\FileNotFoundException
     */
    public function testInspectBadDir()
    {
        Toolstack::inspect('invalid/directory');
    }

    public function testInspectCannotDetect()
    {
        $inspect = Toolstack::inspect('tests/resources/empty');
        $this->assertNull($inspect);
    }
}
