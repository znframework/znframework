<?php namespace ZN\Image;

use GD;

class FlipTest extends Test\GDExtends
{
    public function testFlip()
    {
        GD::canvas(self::img)
          ->filter('colorize', 80, 50, 60)
          ->flip()
          ->generate('png', $generateFile = self::dir . 'image-flip.png');

        $this->assertFileExists($generateFile);
    }
}