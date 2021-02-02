<?php namespace ZN\Crontab;

use Crontab;

class ListTest extends \PHPUnit\Framework\TestCase
{    
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
}