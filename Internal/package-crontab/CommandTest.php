<?php namespace ZN\Crontab;

use Crontab;

class CommandTest extends \PHPUnit\Framework\TestCase
{
    public function testRunCommandDaily()
    {
        Crontab::daily()->command('ExampleCommand:exampleMethod');

        $this->assertStringContainsString('0 0 * * *', Crontab::list());

        Crontab::remove('ExampleCommand');
    }

    public function testRunCommandWithDayAndClock()
    {
        Crontab::day('monday')->clock('10:00')->command('ExampleCommand:exampleMethod');

        $this->assertStringContainsString('00 10 * * 1', Crontab::list());

        Crontab::remove('ExampleCommand');
    }

    public function testRunCommandSendParametersPerminute()
    {
        Crontab::perminute(5)->parameters('1', '2')->command('ExampleCommand:exampleMethod');

        $this->assertStringContainsString('(new \Project\Commands\ExampleCommand)->exampleMethod("1","2")', Crontab::list());

        Crontab::remove('ExampleCommand');
    }

    public function testRunCommandSendPerhour()
    {
        Crontab::perhour(2)->command('ExampleCommand:exampleMethod');

        $this->assertStringContainsString('* */2 * * *', Crontab::list());

        Crontab::remove('ExampleCommand');
    }
}