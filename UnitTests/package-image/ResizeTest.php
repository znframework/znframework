<?php namespace ZN\Image;

use GD;

class ResizeTest extends Test\GDExtends
{
    public function testResize()
    {
        GD::canvas(self::img)
          ->target(50, 50)
          ->source(300, 450)
          ->targetWidth(300)
          ->targetHeight(300)
          ->sourceWidth(10)
          ->sourceHeight(10)
          ->resize(self::dir . 'image-convolution.png')
          ->generate('png', $generateFile = self::dir . 'image-resize.png');

        $this->assertFileExists($generateFile);
    }
}