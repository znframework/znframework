<?php namespace ZN\Console;

use File;
use Crontab;

class CronTest extends \PHPUnit\Framework\TestCase
{
    public function testCronSingleParameter()
    {
        $file = EXTERNAL_DIR . 'Crontab/Jobs';

        new Cron('Example:run', ['daily']);

        $length = strlen(File::read($file));

        $this->assertTrue($length > 1);

        if( is_file($file) )
        {
            File::write($file, '');
        }
    }

    public function testCronMultiParameter()
    {
        $file = EXTERNAL_DIR . 'Crontab/Jobs';

        new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);

        $length = strlen(File::read($file));

        $this->assertTrue($length > 1);

        if( is_file($file) )
        {
            File::write($file, '');
        }
    }

    public function testCronList()
    {
        $file = EXTERNAL_DIR . 'Crontab/Jobs';

        new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);

        $array = Crontab::listArray();

        $this->assertTrue(count($array) > 0);

        if( is_file($file) )
        {
            File::write($file, '');
        }
    }

    public function testRemoveCron()
    {
        $file = EXTERNAL_DIR . 'Crontab/Jobs';

        new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);
        new RemoveCron('Example');

        $array = Crontab::listArray();

        $this->assertSame(0, count($array));
    }
}