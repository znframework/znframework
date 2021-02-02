<?php namespace ZN\Captcha;

use Captcha;

class GridTest extends CaptchaExtends
{
    public function testGridColor()
    {
        Captcha::path(self::directory)->gridColor('30|89|178')->create(true);

        $this->isEquals();
    }

    public function testGridSpace()
    {
        Captcha::path(self::directory)->gridSpace(5, 3)->gridColor('30|89|178')->create(true);

        $this->isEquals();
    }
}