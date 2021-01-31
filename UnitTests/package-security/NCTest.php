<?php namespace ZN\Security;

use Security;

class NCTest extends \PHPUnit\Framework\TestCase
{
    public function testNC()
    {
        $this->assertEquals('hi [x]', Security::ncEncode('hi bro', 'bro', '[x]'));
    }
}