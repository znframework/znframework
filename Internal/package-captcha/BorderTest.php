<?php namespace ZN\Captcha;

use Captcha;

class BorderTest extends CaptchaExtends
{
    public function testBorderColor()
    {
        Captcha::path(self::directory)->borderColor('255|0|0')->create(true);

        $this->isEquals();
    }
}