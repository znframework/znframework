<?php namespace ZN\Captcha;

use Captcha;

class TextTest extends CaptchaExtends
{
    public function testTextSize()
    {
        Captcha::path(self::directory)->textSize(1)->create(true);

        $this->isEquals();
    }

    public function testTextLength()
    {
        Captcha::path(self::directory)->length(3)->create(true);

        $this->isEquals(3);
    }

    public function testTextColor()
    {
        Captcha::path(self::directory)->textColor('30|89|178')->create(true);
        
        $this->isEquals();
    }
}