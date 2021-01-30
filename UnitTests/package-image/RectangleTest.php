<?php namespace ZN\Image;

use GD;

class RectangleTest extends Test\GDExtends
{
    public function testRectangle()
    {
        GD::canvas(400, 400, 'white')
          ->x(0)->y(0)->width(100)->height(100)->color('255|0|255')->rectangle()
          ->x(100)->y(100)->width(100)->height(100)->color('blue')->type('fill')->rectangle()
          ->generate('png', $generateFile = self::dir . 'rectangle-400-400.png');

        $size = GD::size($generateFile);

        $this->assertSame([400, 400], [$size->width, $size->height]);
    }
}