<?php namespace ZN\Crontab;

use Crontab;

class ControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testRunControllerDaily()
    {
        Crontab::daily()->controller('ExampleController/exampleMethod');

        $this->assertStringContainsString('0 0 * * *', Crontab::list());

        Crontab::remove('ExampleController');
    }

    public function testRunControllerWithDayAndClock()
    {
        Crontab::day('monday')->clock('10:00')->controller('ExampleController/exampleMethod');

        $this->assertStringContainsString('00 10 * * 1', Crontab::list());

        Crontab::remove('ExampleController');
    }

    public function testRunControllerSendPerhour()
    {
        Crontab::perhour(2)->controller('ExampleController/exampleMethod');

        $this->assertStringContainsString('* */2 * * *', Crontab::list());

        Crontab::remove('ExampleController');
    }

    public function testRunControllerSendParemetersPerhour()
    {
        Crontab::perhour(2)->controller('ExampleController/exampleMethod3/a/b/c');

        $this->assertStringContainsString('* */2 * * *', Crontab::list());

        Crontab::remove('ExampleController');
    }
}