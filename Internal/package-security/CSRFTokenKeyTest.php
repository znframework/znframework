<?php namespace ZN\Security;

use Security;

class CSRFTokenKeyTest extends \PHPUnit\Framework\TestCase
{
    public function testCSRFToken()
    {
        $this->assertIsString(Security::CSRFTokenKey());
    }
}