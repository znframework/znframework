<?php namespace ZN\Request;

use URI;

class URIManipulationTest extends \PHPUnit\Framework\TestCase
{
    public function testUriManiputlationChangeValues()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('contact/abc/sendForm/example', URI::manipulation(['contact' => 'abc', 'sendForm' => 'example']));
    }

    public function testUriManiputlationDefaultValues()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('contact/us/sendForm/example', URI::manipulation(['contact', 'sendForm' => 'example']));
    }

    public function testUriManiputlationBothFix()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('/contact/us/sendForm/example/', URI::manipulation(['contact', 'sendForm' => 'example'], 'both'));
    }

    public function testUriManiputlationLeftFix()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('/contact/us/sendForm/example', URI::manipulation(['contact', 'sendForm' => 'example'], 'left'));
    }

    public function testUriManiputlationRightFix()
    {
        $_SERVER['PATH_INFO'] = 'contact/us/sendForm';

        $this->assertEquals('contact/us/sendForm/example/', URI::manipulation(['contact', 'sendForm' => 'example'], 'right'));
    }
}