<?php namespace ZN\Crontab;

use Crontab;

class WgetTest extends \PHPUnit\Framework\TestCase
{    
    public function testRunWget()
    {
        Crontab::daily()->wget('https://site.com/example/page');

        $this->assertStringContainsString('https://site.com/example/page', Crontab::list());

        Crontab::remove('https://site.com/example/page');
    }
}