<?php namespace ZN\Crontab;

use Crontab;

class RemoveTest extends \PHPUnit\Framework\TestCase
{    
    public function testRemoveCronByID()
    {
        Crontab::path('/opt/lampp/bin/php')->daily()->command('ExampleCommand:exampleMethod');

        Crontab::remove(0);
        Crontab::remove(0);

        $this->assertEmpty(Crontab::listArray()[0] ?? NULL);
    }

    public function testRemoveCronByFilter()
    {
        Crontab::command('ExampleCommand:exampleMethod');

        Crontab::remove('ExampleCommand');

        $this->assertEmpty(Crontab::listArray());
    }
}