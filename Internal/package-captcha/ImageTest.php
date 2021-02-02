<?php namespace ZN\Captcha;

use Captcha;

class ImageTest extends CaptchaExtends
{
    public function testImage()
    {
        Captcha::path(self::directory)->create(true);

        $this->isEquals();
    }
}