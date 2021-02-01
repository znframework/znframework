<?php namespace ZN\Image;

use GD;

class SmoothTest extends Test\GDExtends
{
    public function testSmooth()
    {
        GD::canvas(self::img)
          ->smooth(true)
          ->generate('png', $generateFile = self::dir . 'image-smooth.png');

        $this->assertFileExists($generateFile);
    }
}