<?php namespace ZN\Captcha;

use Captcha;

class BackgroundTest extends CaptchaExtends
{
    public function testBackgroundColor()
    {
        Captcha::path(self::directory)->bgColor('30|89|178')->create(true);

        $this->isEquals();
    }
}