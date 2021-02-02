<?php namespace ZN\Crontab;

use Crontab;

class CrontabTest extends \PHPUnit\Framework\TestCase
{
    public function testRunControllerDaily()
    {
        Crontab::daily()->controller('ExampleController/exampleMethod1');

        $this->assertIsString(Crontab::listArray()[4]);
    }

    public function testRunControllerWithDayAndClock()
    {
        Crontab::day('monday')->clock('10:00')->controller('ExampleController/exampleMethod2');

        $this->assertIsString(Crontab::listArray()[5]);
    }

    public function testRunControllerSendPerhour()
    {
        Crontab::perhour(2)->controller('ExampleController/exampleMethod3');

        $this->assertIsString(Crontab::listArray()[6]);
    }

    public function testRunControllerSendParemetersPerhour()
    {
        Crontab::perhour(2)->controller('ExampleController/exampleMethod3/a/b/c');

        $this->assertIsString(Crontab::listArray()[7]);
    }
    
    public function testRunWget()
    {
        Crontab::daily()->wget('https://site.com/example/page');

        $this->assertIsString(Crontab::listArray()[8]);
    }

    public function testRunCronSetPHPPath()
    {
        Crontab::path('/opt/lampp/bin/php')->daily()->command('ExampleCommand:exampleMethod5');

        $this->assertIsString(Crontab::listArray()[9]);
    }

    public function testCronList()
    {
        $cronList = Crontab::list();

        $this->assertIsString($cronList);
    }

    public function testCronListArray()
    {
        $cronList = Crontab::listArray();

        $this->assertIsArray($cronList);
    }

    public function testRemoveCronByID()
    {
        $beforeCronList = Crontab::listArray();

        Crontab::remove(0);

        $afterCronList = Crontab::listArray();

        $this->assertTrue($beforeCronList != $afterCronList);
    }

    public function testRemoveCronByFilter()
    {
        $beforeCronList = Crontab::listArray();

        Crontab::remove('exampleMethod3');

        $afterCronList = Crontab::listArray();

        $this->assertTrue($beforeCronList != $afterCronList);
    }
}