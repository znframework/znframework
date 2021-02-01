<?php namespace ZN\Helpers;

use Symbol;

class SymbolTest extends \PHPUnit\Framework\TestCase
{
    public function testCall()
    {
        $this->assertSame('&copy;', Symbol::copyright());
    }
}