<?php namespace ZN\Captcha;

class CaptchaTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateOnlyLink()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->create());
    }

    public function testCreateHtmlImage()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->create(true));
    }

    public function testCreateHtmlImageChangePath()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeTextSize()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->textSize(1)->create(true));
    }

    public function testCreateHtmlImageWithNumericType()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->path(UPLOADS_DIR)->type('numeric')->create(true));
    }
    
    public function testCreateHtmlImageChangeTextLength()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->length(3)->path(UPLOADS_DIR)->type('numeric')->create(true));
    }

    public function testCreateHtmlImageChangeTextLengthAndTypeAlpha()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->length(3)->path(UPLOADS_DIR)->type('alpha')->create(true));
    }

    public function testCreateHtmlImageChangeBorderColor()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->borderColor('255|0|0')->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeBackgorundColor()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->bgColor('30|89|178')->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeCoordinate()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->textCoordinate(40, 10)->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeTextColor()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->textColor('30|89|178')->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeGridColor()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->path(UPLOADS_DIR)->create(true));
    }

    public function testCreateHtmlImageChangeGridSpace()
    {
        $captcha = new Render;

        $this->assertTrue((bool) $captcha->gridSpace(5, 3)->gridColor('30|89|178')->path(UPLOADS_DIR)->create(true));
    }
}