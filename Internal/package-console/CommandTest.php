<?php namespace ZN\Console;

use File;

class CommandTest extends \PHPUnit\Framework\TestCase
{
    public function testCommandList()
    {
        return;

        new CommandList;
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

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }
}