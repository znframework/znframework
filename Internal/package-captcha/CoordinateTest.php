<?php namespace ZN\Captcha;

use Captcha;

class CoordinateTest extends CaptchaExtends
{
    public function testCoordinate()
    {
        Captcha::path(self::directory)->textCoordinate(40, 10)->create(true);

        $this->isEquals();
    }
}