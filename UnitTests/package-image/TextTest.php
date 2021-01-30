<?php namespace ZN\Image;

use GD;

class TextTest extends Test\GDExtends
{
    public function testText()
    {
        GD::canvas(300, 300, 'white')
          ->color('red')->font(5)->x(40)->y(100)->type('vertical')->text('Hello!')
          ->generate('png', $generateFile = self::dir . 'text-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }
}