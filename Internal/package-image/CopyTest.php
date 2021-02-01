<?php namespace ZN\Image;

use GD;

class CopyTest extends Test\GDExtends
{
    public function testCopy()
    {
        GD::canvas(self::img)
          ->target(50, 50)
          ->source(300, 450)
          ->width(200)
          ->height(200)
          ->copy(self::dir . 'image-convolution.png')
          ->generate('png', $generateFile = self::dir . 'image-copy.png');

        $this->assertFileExists($generateFile);
    }
}