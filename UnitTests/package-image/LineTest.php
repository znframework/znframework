<?php namespace ZN\Image;

use GD;

class LineTest extends Test\GDExtends
{
    public function testLine()
    {
        GD::canvas(400, 400, 'transparent')
          ->x1(100)->y1(100)->x2(200)->y2(200)->color('red')->line()
          ->x1(100)->y1(100)->x2(0)->y2(0)->color('blue')->line()
          ->generate('png', $generateFile = self::dir . 'line-400-400.png');

        $size = GD::size($generateFile);

        $this->assertSame([400, 400], [$size->width, $size->height]);
    }
}