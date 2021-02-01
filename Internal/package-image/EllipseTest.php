<?php namespace ZN\Image;

use GD;

class EllipseTest extends Test\GDExtends
{
    public function testEllipse()
    {
        GD::canvas(300, 300, 'white')
        ->x(100)->y(100)->width(100)->height(100)->color('red')->type('fill')->ellipse()
        ->generate('jpeg', $generateFile = self::dir . 'ellipse-300-300.jpg');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }
}