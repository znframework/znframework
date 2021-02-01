<?php namespace ZN\Image;

use GD;

class ConvolutionTest extends Test\GDExtends
{
    public function testConvolution()
    {
        GD::canvas(self::img)
          ->convolution([[2, 0, 0], [0, -1, 0], [0, 0, -1]], 1, 127)
          ->generate('png', $generateFile = self::dir . 'image-convolution.png');

        $this->assertFileExists($generateFile);
    }
}