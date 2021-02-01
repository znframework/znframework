<?php namespace ZN\Image;

use GD;

class FiltersTest extends Test\GDExtends
{
    public function testFilters()
    {
        GD::canvas(self::img)
          ->filter('colorize', 80, 50, 60)
          ->brightness(80)
          ->generate('png', $generateFile = self::dir . 'image-colorize.png');

        $this->assertFileExists($generateFile);
    }
}