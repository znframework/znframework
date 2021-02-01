<?php namespace ZN\Image;

use GD;

class InterpolationTest extends Test\GDExtends
{
    public function testInterpolation()
    {
        GD::canvas(self::img)
          ->interpolation('bell')
          ->generate('png', $generateFile = self::dir . 'image-interpolation.png');

        $this->assertFileExists($generateFile);
    }
}