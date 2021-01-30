<?php namespace ZN\Image;

use GD;
use File;
use Buffer;

class GDTest extends \PHPUnit\Framework\TestCase
{
    const dir = 'UnitTests/package-image/resources/';
    const img = self::dir . 'image.jpg';

    private function buffer($file, $callback)
    {
        $this->assertSame
        (
            Buffer::callback(function() use($callback, $file)
            { 
                $callback(); 
            }), 

            File::read(self::dir . $file)
        );
    }

    public function testCanvas()
    {
        $this->buffer('canvas-200-400.png', function()
        { 
            GD::canvas(200, 400, 'white')->generate('png'); 
        });
    }

    public function testLine()
    {
        $this->buffer('line-400-400.png', function()
        { 
            GD::canvas(400, 400, 'transparent')
            ->x1(100)->y1(100)->x2(200)->y2(200)->color('red')->line()
            ->x1(100)->y1(100)->x2(0)->y2(0)->color('blue')->line()
            ->generate('png');
        });
    }

    public function testRectangle()
    {
        $this->buffer('rectangle-400-400.png', function()
        { 
            GD::canvas(400, 400, 'white')
            ->x(0)->y(0)->width(100)->height(100)->color('255|0|255')->rectangle()
            ->x(100)->y(100)->width(100)->height(100)->color('blue')->type('fill')->rectangle()
            ->generate('png');
        });
    }

    public function testArc()
    {
        $this->buffer('arc-200-200.png', function()
        { 
            GD::canvas(200, 200, 'white')
            ->x(0)->y(0)->width(100)->height(100)->color('pink')->start(0)->end(90)->type('pie')->arc()
            ->generate('png');
        });
    }

    public function testEllipse()
    {
        $this->buffer('ellipse-300-300.jpg', function()
        { 
            GD::canvas(300, 300, 'white')
            ->x(100)->y(100)->width(100)->height(100)->color('red')->type('fill')->ellipse()
            ->generate('jpeg');
        });
    }

    public function testPolygon()
    {
        $this->buffer('polygon-300-300.png', function()
        { 
            GD::canvas(300, 300, 'red')
            ->color('white')->points([0, 0, 100, 200, 300, 200])->polygon()
            ->generate('png');
        });
    }

    public function testChar()
    {
        $this->buffer('char-300-300.png', function()
        { 
            GD::canvas(300, 300, 'white')
            ->color('red')->font(5)->x(40)->y(40)->char('H')
            ->generate('png');
        });
    }

    public function testText()
    {
        $this->buffer('text-300-300.png', function()
        { 
            GD::canvas(300, 300, 'white')
            ->color('red')->font(5)->x(40)->y(100)->type('vertical')->text('Hello!')
            ->generate('png');
        });
    }

    public function testFill()
    {
        $this->buffer('fill-300-300.png', function()
        { 
            GD::canvas(300, 300, 'white')
            ->x(100)->y(100)->arc()
            ->x(200)->y(200)->arc()
            ->color('purple')->x(100)->y(100)->fill()
            ->color('blue')->x(200)->y(200)->fill()
            ->generate('png');
        });
    }

    public function testFilters()
    {
        $this->buffer('image-colorize.png', function()
        { 
            GD::canvas(self::img)
            ->filter('colorize', 80, 50, 60)
            ->brightness(80)
            ->generate('png');
        });
    }

    public function testFlip()
    {
        $this->buffer('image-flip.png', function()
        {       
            GD::canvas(self::img)
            ->filter('colorize', 80, 50, 60)
            ->flip()
            ->generate('png');
        });
    }

    public function testAlphaBlending()
    {
        $this->buffer('image-alphablending.png', function()
        {       
            GD::canvas(self::img)
            ->alphaBlending(true)
            ->generate('png');
        });
    }

    public function testSaveAlpha()
    {
        $this->buffer('image-savealpha.png', function()
        {       
            GD::canvas(self::img)
            ->alphaBlending(true)
            ->saveAlpha(true)
            ->generate('png');
        });
    }

    public function testSmooth()
    {
        $this->buffer('image-smooth.png', function()
        {       
            GD::canvas(self::img)
            ->smooth(true)
            ->generate('png');
        });
    }

    public function testConvolution()
    {
        $this->buffer('image-convolution.png', function()
        {       
            GD::canvas(self::img)
            ->convolution([[2, 0, 0], [0, -1, 0], [0, 0, -1]], 1, 127)
            ->generate('png');
        });
    }

    public function testInterlace()
    {
        $this->buffer('image-interlace.png', function()
        {       
            GD::canvas(self::img)
            ->interlace(1)
            ->generate('png');
        });
    }

    public function testMix()
    {
        $this->buffer('image-mix.png', function()
        {       
            GD::canvas(self::img)
            ->target(50, 50)
            ->source(300, 450)
            ->width(200)
            ->height(200)
            ->percent(50)
            ->mix(self::dir . 'image-convolution.png')
            ->generate('png');
        });
    }

    public function testCopy()
    {
        $this->buffer('image-copy.png', function()
        {       
            GD::canvas(self::img)
            ->target(50, 50)
            ->source(300, 450)
            ->width(200)
            ->height(200)
            ->copy(self::dir . 'image-convolution.png')
            ->generate('png');
        });
    }

    public function testResize()
    {
        $this->buffer('image-resize.png', function()
        {       
            GD::canvas(self::img)
            ->target(50, 50)
            ->source(300, 450)
            ->targetWidth(300)
            ->targetHeight(300)
            ->sourceWidth(10)
            ->sourceHeight(10)
            ->resize(self::dir . 'image-convolution.png')
            ->generate('png');
        });
    }

    public function testCrop()
    {
        $this->buffer('image-crop.png', function()
        {       
            GD::canvas(self::img)
            ->x(100)->y(100)->width(100)->height(300)->crop()
            ->generate('png');
        });
    }

    public function testAutoCrop()
    {
        $this->buffer('image-autocrop.png', function()
        {       
            GD::canvas(self::img)
            ->autoCrop('threshold', .5, '0|0|170')
            ->generate('png');
        });
    }

    public function testQuality()
    {
        $this->buffer('image-quality.png', function()
        {       
            GD::canvas(self::img)
            ->quality(1)
            ->generate('png');
        });
    }

    public function testRotate()
    {
        $this->buffer('image-rotate.png', function()
        {       
            GD::canvas(self::img)
            ->rotate(90)
            ->generate('png');
        });
    }

    public function testScale()
    {
        $this->buffer('image-scale.png', function()
        {       
            GD::canvas(self::img)
            ->scale(100)
            ->generate('png');
        });
    }

    public function testInterpolation()
    {
        $this->buffer('image-interpolation.png', function()
        {       
            GD::canvas(self::img)
            ->interpolation('bell')
            ->generate('png');
        });
    }
}