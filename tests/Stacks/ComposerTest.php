<?php
/**
 * Created by PhpStorm.
 * User: mglaman
 * Date: 8/28/15
 * Time: 1:38 AM
 */

namespace mglaman\Toolstack\Tests\Stacks;


use mglaman\Toolstack\Stacks;
use mglaman\Toolstack\Toolstack;

class ComposerTest extends \PHPUnit_Framework_TestCase
{
    protected $dir = 'tests/resources/composer';

    /**
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\Composer::inspect()
     * @covers \mglaman\Toolstack\Stacks\Composer::type()
     */
    public function testInspect()
    {
        $type = Toolstack::inspect($this->dir);
        $this->assertEquals(Stacks\Composer::TYPE, $type, 'Directory is a composer project');
    }

    public function testType()
    {
        /** @var Stacks\Composer $stack */
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $this->assertEquals($stack->type(), Stacks\Composer::TYPE);
    }

    /**
     * @covers \mglaman\Toolstack\Toolstack::inspect()
     * @covers \mglaman\Toolstack\Stacks\Composer::installed()
     */
    public function testInstalled()
    {
        /** @var Stacks\Composer $stack */
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $bool = $stack->installed($this->dir);
        $this->assertTrue($bool, 'Composer project is installed');
    }

    /**
     * @covers \mglaman\Toolstack\Stacks\Composer::composerFilePath()
     */
    public function testComposerFilePath()
    {
        $path = $this->dir . '/composer.json';
        /** @var Stacks\Composer $stack */
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $this->assertEquals($path, $stack->composerFilePath($this->dir));
    }

    /**
     * @covers \mglaman\Toolstack\Stacks\Composer::composerLockPath()
     */
    public function testComposerLockPath()
    {
        $path = $this->dir . '/composer.lock';
        /** @var Stacks\Composer $stack */
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $this->assertEquals($path, $stack->composerLockPath($this->dir));
    }

    /**
     * @covers \mglaman\Toolstack\Stacks\Composer::getComposerData()
     */
    public function testComposerData()
    {
        /** @var Stacks\Composer $stack */
        $stack = Toolstack::getStackByType(Stacks\Composer::TYPE);
        $data = $stack->getComposerData($this->dir);

        $this->assertEquals([
            'require' => [
                'drupal/core' => 'dev-master',
            ],
        ], $data);
    }
}
