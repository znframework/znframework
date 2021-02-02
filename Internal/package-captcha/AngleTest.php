<?php namespace ZN\Captcha;

use Captcha;

class AngleTest extends CaptchaExtends
{
    public function testAngleTest()
    {
        $resources = self::directory . 'fonts/';

        $fonts = 
        [
            $resources . 'Blooms.ttf',
            $resources . 'BungeeShade-Regular.ttf',
            $resources . 'Calistoga-Regular.ttf',
            $resources . 'SairaStencilOne-Regular'
        ];

        Captcha::path(self::directory)->ttf($fonts)->angle(rand(0, 20))->create(true);

        $this->isEquals();
    }
}