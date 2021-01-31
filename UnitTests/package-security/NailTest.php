<?php namespace ZN\Security;

use Security;

class NailTest extends \PHPUnit\Framework\TestCase
{
    public function testNailEncode()
    {
        $this->assertEquals('ZN&#34; Framework', Security::nailEncode('ZN" Framework'));
    }

    public function testNailDecode()
    {
        $this->assertEquals('ZN" Framework', Security::nailDecode('ZN&#34; Framework'));
    }
}