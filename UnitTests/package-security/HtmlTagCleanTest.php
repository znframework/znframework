<?php namespace ZN\Security;

use Security;

class HtmlTagCleanTest extends \PHPUnit\Framework\TestCase
{
    public function testHtmlTagClean()
    {
        $this->assertEquals('ZN Framework', Security::htmlTagClean('<b>ZN Framework</b>'));
    }

    public function testHtmlTagCleanAllowableParameter()
    {
        $this->assertEquals('<i>ZN Framework</i>', Security::htmlTagClean('<b><i>ZN Framework</i></b>', '<i>'));
    }

    public function testHtmlTagCleanAllowableParameterArray()
    {
        $this->assertEquals('<b><i>ZN Framework</i></b>', Security::htmlTagClean('<b><i>ZN Framework</i></b>', ['i', 'b']));
    }
}