<?php namespace ZN\Console;

use File;
use Buffer;

class CommandTest extends \PHPUnit\Framework\TestCase
{
    public function testCommandList()
    {
        $list = Buffer::callback(function()
        {
            new CommandList;
        });
        
        $this->assertIsString($list);
    }

    public function testCreateCommand()
    {
        new CreateCommand('Example');

        $this->assertFileExists($file = COMMANDS_DIR . 'Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testDeleteCommand()
    {
        new CreateCommand('Example');
        new DeleteCommand('Example');

        $file = COMMANDS_DIR . 'Example.php';

        $this->assertFalse(is_file($file));
    }
}