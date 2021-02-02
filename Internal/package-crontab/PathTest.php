<?php namespace ZN\Crontab;

use Crontab;

class PathTest extends \PHPUnit\Framework\TestCase
{    
    public function testRunCronSetPHPPath()
    {
        Crontab::path('/opt/lampp/bin/php')->daily()->command('ExampleCommand:exampleMethod');

        $this->assertStringContainsString('/opt/lampp/bin/php', Crontab::list());

        Crontab::remove('/opt/lampp/bin/php');
    }
}