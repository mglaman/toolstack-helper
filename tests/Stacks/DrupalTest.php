<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 3:28 AM
 */

namespace mglaman\Toolstack\Tests\Stacks;


use mglaman\Toolstack\Toolstack;
use mglaman\Toolstack\Stacks;

class DrupalTest extends \PHPUnit_Framework_TestCase
{
    protected $dir = 'tests/resources/drupal';

    /**
     * @return array
     */
    public function getTestDirs()
    {
        return [
          $this->dir . '/core',
          $this->dir . '/make',
          $this->dir . '/make-yml'
        ];
    }

    /**
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\Drupal::inspect()
     * @covers \mglaman\Toolstack\Stacks\Drupal::type()
     * @covers \mglaman\Toolstack\Stacks\Drupal::source()
     * @covers \mglaman\Toolstack\Stacks\Drupal::getMakefiles()
     * @covers \mglaman\Toolstack\Stacks\Drupal::built()
     */
    public function testInspect()
    {
        // Test core
        foreach ($this->getTestDirs() as $testDir) {
            $type = Toolstack::inspect($testDir);
            $this->assertEquals(Stacks\Drupal::TYPE, $type, "$testDir is a Drupal project");
        }
    }

    public function testType()
    {
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::getStackByType(Stacks\Drupal::TYPE);
        $this->assertEquals($stack->type(), Stacks\Drupal::TYPE);
    }

    public function testBuilt()
    {
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::getStackByType(Stacks\Drupal::TYPE);

        $this->assertTrue($stack->built($this->dir . '/core'));
        $this->assertFalse($stack->built($this->dir . '/empty'));
    }
}
