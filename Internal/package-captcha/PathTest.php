<?php namespace ZN\Captcha;

use Folder;
use Captcha;

class PathTest extends CaptchaExtends
{
    public function testCreateHtmlImageChangePath()
    {
        Folder::create($path = self::directory . 'resources/');

        Captcha::path($path)->create();

        $this->assertFileExists($path . $this->getFileName());

        Folder::delete($path);
    }
}