<?php namespace ZN\Image;

use GD;

class CharTest extends Test\GDExtends
{
    public function testChar()
    {
        GD::canvas(300, 300, 'white')
          ->color('red')->font(5)->x(40)->y(40)->char('H')
          ->generate('png', $generateFile = self::dir . 'char-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }
}