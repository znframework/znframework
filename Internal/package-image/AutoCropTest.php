<?php namespace ZN\Image;

use GD;

class AutoCropTest extends Test\GDExtends
{
    public function testAutoCrop()
    {
        GD::canvas(self::img)
          ->autoCrop('threshold', .5, '0|0|170')
          ->generate('png', $generateFile = self::dir . 'image-autocrop.png');

        $this->assertFileExists($generateFile);
    }
}