<?php namespace ZN\Captcha;

use Captcha;

class TypeTest extends CaptchaExtends
{
    public function testDefaultAlnumType()
    {
        Captcha::path(self::directory)->type('alnum')->create(true);

        $this->isEquals();
    }

    public function testNumericType()
    {
        Captcha::path(self::directory)->type('numeric')->create(true);

        $this->isEquals();
    }

    public function testAlphaType()
    {
        Captcha::path(self::directory)->type('alpha')->create(true);

        $this->isEquals();
    }
}