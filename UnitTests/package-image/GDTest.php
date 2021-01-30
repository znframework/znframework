<?php namespace ZN\Image;

use GD;

class GDTest extends \PHPUnit\Framework\TestCase
{
    const dir = 'UnitTests/package-image/resources/';
    const img = self::dir . 'image.jpg';

    public function testCanvas()
    {
        GD::canvas(200, 400, 'white')->generate('png', $generateFile = self::dir . 'canvas-200-400.png');

        $size = GD::size($generateFile);

        $this->assertSame([200, 400], [$size->width, $size->height]);
    }

    public function testLine()
    {
        GD::canvas(400, 400, 'transparent')
          ->x1(100)->y1(100)->x2(200)->y2(200)->color('red')->line()
          ->x1(100)->y1(100)->x2(0)->y2(0)->color('blue')->line()
          ->generate('png', $generateFile = self::dir . 'line-400-400.png');

        $size = GD::size($generateFile);

        $this->assertSame([400, 400], [$size->width, $size->height]);
    }

    public function testRectangle()
    {
        GD::canvas(400, 400, 'white')
          ->x(0)->y(0)->width(100)->height(100)->color('255|0|255')->rectangle()
          ->x(100)->y(100)->width(100)->height(100)->color('blue')->type('fill')->rectangle()
          ->generate('png', $generateFile = self::dir . 'rectangle-400-400.png');

        $size = GD::size($generateFile);

        $this->assertSame([400, 400], [$size->width, $size->height]);
    }

    public function testArc()
    {
        GD::canvas(200, 200, 'white')
            ->x(0)->y(0)->width(100)->height(100)->color('pink')->start(0)->end(90)->type('pie')->arc()
            ->generate('png', $generateFile = self::dir . 'arc-200-200.png');

        $size = GD::size($generateFile);

        $this->assertSame([200, 200], [$size->width, $size->height]);
    }

    public function testEllipse()
    {
        GD::canvas(300, 300, 'white')
        ->x(100)->y(100)->width(100)->height(100)->color('red')->type('fill')->ellipse()
        ->generate('jpeg', $generateFile = self::dir . 'ellipse-300-300.jpg');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }

    public function testPolygon()
    {
        GD::canvas(300, 300, 'red')
          ->color('white')->points([0, 0, 100, 200, 300, 200])->polygon()
          ->generate('png', $generateFile = self::dir . 'polygon-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }

    public function testChar()
    {
        GD::canvas(300, 300, 'white')
          ->color('red')->font(5)->x(40)->y(40)->char('H')
          ->generate('png', $generateFile = self::dir . 'char-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }

    public function testText()
    {
        GD::canvas(300, 300, 'white')
          ->color('red')->font(5)->x(40)->y(100)->type('vertical')->text('Hello!')
          ->generate('png', $generateFile = self::dir . 'text-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }

    public function testFill()
    {
        GD::canvas(300, 300, 'white')
          ->x(100)->y(100)->arc()
          ->x(200)->y(200)->arc()
          ->color('purple')->x(100)->y(100)->fill()
          ->color('blue')->x(200)->y(200)->fill()
          ->generate('png', $generateFile = self::dir . 'fill-300-300.png');

        $size = GD::size($generateFile);

        $this->assertSame([300, 300], [$size->width, $size->height]);
    }

    public function testFilters()
    {
        GD::canvas(self::img)
          ->filter('colorize', 80, 50, 60)
          ->brightness(80)
          ->generate('png', $generateFile = self::dir . 'image-colorize.png');

        $this->assertFileExists($generateFile);
    }

    public function testFlip()
    {
        GD::canvas(self::img)
          ->filter('colorize', 80, 50, 60)
          ->flip()
          ->generate('png', $generateFile = self::dir . 'image-flip.png');

        $this->assertFileExists($generateFile);
    }

    public function testAlphaBlending()
    {
        GD::canvas(self::img)
          ->alphaBlending(true)
          ->generate('png', $generateFile = self::dir . 'image-alphablending.png');

        $this->assertFileExists($generateFile);
    }

    public function testSaveAlpha()
    {
        GD::canvas(self::img)
          ->alphaBlending(true)
          ->saveAlpha(true)
          ->generate('png', $generateFile = self::dir . 'image-savealpha.png');

        $this->assertFileExists($generateFile);
    }

    public function testSmooth()
    {
        GD::canvas(self::img)
          ->smooth(true)
          ->generate('png', $generateFile = self::dir . 'image-smooth.png');

        $this->assertFileExists($generateFile);
    }

    public function testConvolution()
    {
        GD::canvas(self::img)
          ->convolution([[2, 0, 0], [0, -1, 0], [0, 0, -1]], 1, 127)
          ->generate('png', $generateFile = self::dir . 'image-convolution.png');

        $this->assertFileExists($generateFile);
    }

    public function testInterlace()
    {
        GD::canvas(self::img)
          ->interlace(1)
          ->generate('png', $generateFile = self::dir . 'image-interlace.png');

        $this->assertFileExists($generateFile);
    }

    public function testMix()
    {
        GD::canvas(self::img)
          ->target(50, 50)
          ->source(300, 450)
          ->width(200)
          ->height(200)
          ->percent(50)
          ->mix(self::dir . 'image-convolution.png')
          ->generate('png', $generateFile = self::dir . 'image-mix.png');

        $this->assertFileExists($generateFile);
    }

    public function testCopy()
    {
        GD::canvas(self::img)
          ->target(50, 50)
          ->source(300, 450)
          ->width(200)
          ->height(200)
          ->copy(self::dir . 'image-convolution.png')
          ->generate('png', $generateFile = self::dir . 'image-copy.png');

        $this->assertFileExists($generateFile);
    }

    public function testResize()
    {
        GD::canvas(self::img)
          ->target(50, 50)
          ->source(300, 450)
          ->targetWidth(300)
          ->targetHeight(300)
          ->sourceWidth(10)
          ->sourceHeight(10)
          ->resize(self::dir . 'image-convolution.png')
          ->generate('png', $generateFile = self::dir . 'image-resize.png');

        $this->assertFileExists($generateFile);
    }

    public function testCrop()
    {
        GD::canvas(self::img)
          ->x(100)->y(100)->width(100)->height(300)->crop()
          ->generate('png', $generateFile = self::dir . 'image-crop.png');

        $this->assertFileExists($generateFile);
    }

    public function testAutoCrop()
    {
        GD::canvas(self::img)
          ->autoCrop('threshold', .5, '0|0|170')
          ->generate('png', $generateFile = self::dir . 'image-autocrop.png');

        $this->assertFileExists($generateFile);
    }

    public function testQuality()
    {
        GD::canvas(self::img)
          ->quality(1)
          ->generate('png', $generateFile = self::dir . 'image-quality.png');

        $this->assertFileExists($generateFile);
    }

    public function testRotate()
    {
        GD::canvas(self::img)
          ->rotate(90)
          ->generate('png', $generateFile = self::dir . 'image-rotate.png');

        $this->assertFileExists($generateFile);
    }

    public function testScale()
    {
        GD::canvas(self::img)
          ->scale(100)
          ->generate('png', $generateFile = self::dir . 'image-scale.png');

        $this->assertFileExists($generateFile);
    }

    public function testInterpolation()
    {
        GD::canvas(self::img)
          ->interpolation('bell')
          ->generate('png', $generateFile = self::dir . 'image-interpolation.png');

        $this->assertFileExists($generateFile);
    }
}