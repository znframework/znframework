<?php namespace ZN\Image;

use GD;

class ScaleTest extends Test\GDExtends
{
    public function testScale()
    {
        GD::canvas(self::img)
          ->scale(100)
          ->generate('png', $generateFile = self::dir . 'image-scale.png');

        $this->assertFileExists($generateFile);
    }
}