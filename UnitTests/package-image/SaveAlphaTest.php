<?php namespace ZN\Image;

use GD;

class SaveAlphaTest extends Test\GDExtends
{
    public function testSaveAlpha()
    {
        GD::canvas(self::img)
          ->alphaBlending(true)
          ->saveAlpha(true)
          ->generate('png', $generateFile = self::dir . 'image-savealpha.png');

        $this->assertFileExists($generateFile);
    }
}