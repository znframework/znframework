<?php namespace ZN\Image;

use GD;

class AlphaBlendingTest extends Test\GDExtends
{
    public function testAlphaBlending()
    {
        GD::canvas(self::img)
          ->alphaBlending(true)
          ->generate('png', $generateFile = self::dir . 'image-alphablending.png');

        $this->assertFileExists($generateFile);
    }
}