<?php namespace ZN\Image;

use GD;

class PolygonTest extends Test\GDExtends
{
    public function testPolygon()
    {
        GD::canvas(300, 300, 'red')
          ->color('white')->points([0, 0, 100, 200, 300, 200])->polygon()
          ->generate('png', $generateFile = self::dir . 'polygon-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }
}