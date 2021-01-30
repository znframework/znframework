<?php namespace ZN\Image;

use GD;

class QualityTest extends Test\GDExtends
{
    public function testQuality()
    {
        GD::canvas(self::img)
          ->quality(1)
          ->generate('png', $generateFile = self::dir . 'image-quality.png');

        $this->assertFileExists($generateFile);
    }
}