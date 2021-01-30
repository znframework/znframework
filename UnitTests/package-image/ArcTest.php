<?php namespace ZN\Image;

use GD;

class ArcTest extends Test\GDExtends
{
    public function testArc()
    {
        GD::canvas(200, 200, 'white')
            ->x(0)->y(0)->width(100)->height(100)->color('pink')->start(0)->end(90)->type('pie')->arc()
            ->generate('png', $generateFile = self::dir . 'arc-200-200.png');

        $size = GD::size($generateFile);

        $this->assertSame([200, 200], [$size->width, $size->height]);
    }
}