<?php namespace ZN\Security;

use Post;
use Security;

class ValidCSRFTokenKeyTest extends \PHPUnit\Framework\TestCase
{
    public function testValidCSRFTokenKey()
    {
        $xtoken = Security::CSRFTokenKey();

        $_SESSION['xtoken'] = $xtoken; Post::xtoken($xtoken);

        $this->assertTrue(Security::validCSRFTokenKey('xtoken'));

        $ytoken = Security::CSRFTokenKey();

        Post::ytoken('12345');

        $this->assertFalse(Security::validCSRFTokenKey('ytoken'));
    }
}