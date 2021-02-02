<?php namespace ZN\Captcha;

use File;
use Captcha;

class LinkTest extends CaptchaExtends
{
    public function testLink()
    {
        $captcha = Captcha::path(self::directory)->create();

        $this->assertStringContainsString(Captcha::getCode(), $captcha);

        File::delete($file = self::directory . 'captcha-' . Captcha::getCode() . '.png');
    }
}