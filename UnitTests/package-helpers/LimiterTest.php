<?php namespace ZN\Helpers;

use Limiter;

class LimiterTest extends \PHPUnit\Framework\TestCase
{
    public function testWord()
    {
        $this->assertSame('Welcome to...', Limiter::word("Welcome to ZN", 2));
        $this->assertSame('Welcome to ZN', Limiter::word("Welcome to ZN", 3, '+++'));
    }

    public function testChar()
    {
        $this->assertSame('Welcome...', Limiter::char("Welcome to ZN", 7));
        $this->assertSame('Welcome to+++', Limiter::char("Welcome to ZN", 10, '+++'));
    }
}