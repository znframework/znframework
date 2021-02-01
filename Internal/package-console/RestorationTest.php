<?php namespace ZN\Console;

class RestorationTest extends \PHPUnit\Framework\TestCase
{
    public function testStartAndEndRestorationDelete()
    {
        $dir = PROJECTS_DIR . 'MERestore';

        new CreateProject('ME');
        new StartRestoration('ME');
        new EndRestorationDelete('ME');
        new DeleteProject('ME');

        $this->assertFalse(is_dir($dir));
    }
}