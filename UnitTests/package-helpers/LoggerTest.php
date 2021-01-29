<?php namespace ZN\Helpers;

use Config;
use Logger;

class LoggerTest extends \PHPUnit\Framework\TestCase
{
    public function testReport()
    {
        Config::project('log', 
        [
            'createFile' => true,
            'fileTime' => '30 day'
        ]);

        Logger::report('Example Subject', 'Example Message');

        $this->assertFileExists(STORAGE_DIR . 'Logs/Example-Subject.log');
    }

    public function testReportNotice()
    {
        Logger::notice('Notice Message');

        $this->assertFileExists(STORAGE_DIR . 'Logs/notice.log');
    }
}