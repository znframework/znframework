<?php namespace ZN\Captcha;

use Captcha;

class TTFTest extends CaptchaExtends
{
    public function testTTFTest()
    {
        $resources = self::directory . 'fonts/';

        $fonts = 
        [
            $resources . 'Blooms.ttf',
            $resources . 'BungeeShade-Regular.ttf',
            $resources . 'Calistoga-Regular.ttf',
            $resources . 'SairaStencilOne-Regular'
        ];

        Captcha::path(self::directory)->ttf($fonts)->create(true);

        $this->isEquals();
    }
}