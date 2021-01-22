<?php namespace ZN\Captcha;

class RenderTest extends \PHPUnit\Framework\TestCase
{
    public function testPath()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->path(FILES_DIR));
    }

    public function testSize()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->size(200, 50));
    }

    public function testType()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->type('alpha'));
    }

    public function testLength()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->length(10));
    }

    public function testAngle()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->angle(90));
    }

    public function testTtf()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->ttf([]));
    }

    public function testBorderColor()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->borderColor('80|80|80'));
    }

    public function testBgColor()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->bgColor('80|80|80'));
    }

    public function testBgImage()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->bgImage([]));
    }

    public function testTextSize()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->textSize(5));
    }

    public function testTextCoordinate()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->textCoordinate(20, 90));
    }

    public function testTextColor()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->textColor('80|80|80'));
    }

    public function testGridColor()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->gridColor('30|30|30'));
    }

    public function testGridSpace()
    {
        $captcha = new Render;

        $this->assertSame($captcha, $captcha->gridSpace(4,5));
    }

    public function testCreate()
    {
        $captcha = new Render;

        $this->assertIsString($captcha->create());
    }

    public function testGetCode()
    {
        $captcha = new Render;

        $this->assertIsString($captcha->getCode());
    }
}