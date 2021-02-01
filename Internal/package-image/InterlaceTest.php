<?php namespace ZN\Image;

use GD;

class InterlaceTest extends Test\GDExtends
{
    public function testInterlace()
    {
        GD::canvas(self::img)
          ->interlace(1)
          ->generate('png', $generateFile = self::dir . 'image-interlace.png');

        $this->assertFileExists($generateFile);
    }
}