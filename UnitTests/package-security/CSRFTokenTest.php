<?php namespace ZN\Security;

use Get;
use Post;
use Security;

class CSRFTokenTest extends \PHPUnit\Framework\TestCase
{
    public function testCSRFToken()
    {
        $token = Security::CSRFTokenKey();

        Post::token($token);

        Security::CSRFToken();

        $this->assertTrue(true);
    }

    public function testCSRFTokenWithRedirectParameter()
    {
        $token = Security::CSRFTokenKey();

        Post::token($token);

        Security::CSRFToken('home/invalid');

        $this->assertTrue(true);
    }

    public function testCSRFTokenWithMethodParameter()
    {
        $token = Security::CSRFTokenKey();

        Get::token($token);

        Security::CSRFToken('home/invalid', 'get');

        $this->assertTrue(true);
    }
}