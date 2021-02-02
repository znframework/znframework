<?php namespace ZN\Captcha;

use File;
use Captcha;

class CaptchaExtends extends \PHPUnit\Framework\TestCase
{
    const directory = 'Internal/package-captcha/';

    public function __construct()
    {
        parent::__construct();
    }

    public function getFileName()
    {
        return 'captcha-' . Captcha::getCode() . '.png';
    }

    public function isEquals($len = 6)
    {
        $this->assertEquals($len, strlen(Captcha::getCode()));
    }

    public function __destruct()
    {
        if( is_file($file = self::directory . $this->getfileName()) )
        {
            File::delete($file);
        }
    }
}