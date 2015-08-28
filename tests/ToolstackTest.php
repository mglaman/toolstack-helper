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

    /**
     * @covers \mglaman\Toolstack\Toolstack::instance()
     */
    public function testSingletonInstance()
    {
        $singleton = Toolstack::instance()->instance();
        $this->assertInstanceOf('\mglaman\Toolstack\Toolstack', $singleton,
          'Initiate toolstack singleton');
    }

    /**
     * @covers \mglaman\Toolstack\Toolstack::getStacks()
     */
    public function testGetStacks()
    {
        $stacks = Toolstack::instance()->getStacks();
        $this->assertNotEmpty($stacks, 'Toolstack returned array of stacks');
    }

    public function testGetStackByType()
    {
        // @todo this should probably be mocked for proper unit testing.
        $stack = Toolstack::instance()->getStackByType(Stacks\Composer::TYPE);
        $this->assertInstanceOf('\mglaman\Toolstack\Stacks\StacksInterface', $stack);
    }
}
