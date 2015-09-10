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
          $this->dir . '/d7',
          $this->dir . '/d8',
          $this->dir . '/make',
          $this->dir . '/make-yml'
        ];
    }

    public function testInspect()
    {
        // Test core
        foreach ($this->getTestDirs() as $testDir) {
            $stack = Toolstack::inspect($testDir);
            $this->assertEquals(Stacks\Drupal::TYPE, $stack->type(), "$testDir is a Drupal project");
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

        $this->assertTrue($stack->built($this->dir . '/d7'));
        $this->assertFalse($stack->built($this->dir . '/empty'));
    }

    public function testDrupal8()
    {
        $dir = $this->dir . '/d8';
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::inspect($dir);
        $this->assertEquals($stack->type(), Stacks\Drupal::TYPE);
        $this->assertEquals($stack->version($dir), Stacks\Drupal::DRUPAL8);

        $dir = $this->dir . '/make-yml';
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::inspect($dir);
        $this->assertEquals($stack->type(), Stacks\Drupal::TYPE);
        $this->assertEquals($stack->version($dir), Stacks\Drupal::DRUPAL8);
    }

    public function testDrupal7()
    {
        $dir = $this->dir . '/d7';
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::inspect($dir);
        $this->assertEquals($stack->type(), Stacks\Drupal::TYPE);
        $this->assertEquals($stack->version($dir), Stacks\Drupal::DRUPAL7);

        $dir = $this->dir . '/make';
        /** @var Stacks\Drupal $stack */
        $stack = Toolstack::inspect($dir);
        $this->assertEquals($stack->type(), Stacks\Drupal::TYPE);
        $this->assertEquals($stack->version($dir), Stacks\Drupal::DRUPAL7);
    }
}
