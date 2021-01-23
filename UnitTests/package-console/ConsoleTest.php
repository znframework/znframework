<?php namespace ZN\Console;

use File;
use Cache;
use Folder;
use Buffer;
use Console;
use Crontab;
use Processor;

class ConsoleTest extends \PHPUnit\Framework\TestCase
{
    public function testCleanCache()
    {
        Cache::insert('a', 'value');

        $this->assertSame('value', Cache::select('a'));

        Buffer::callback(function()
        {
            new CleanCache;
        });

        $this->assertSame(false, Cache::select('a'));
    }

    public function testCommandList()
    {
        $output = Buffer::callback(function()
        {
            new CommandList;
        });

        $this->assertIsString($output);
    }
 
    public function testRunController()
    {
       
    }

    public function testCreateCommand()
    {
        Buffer::callback(function()
        {
            new CreateCommand('Example');
        });

        $this->assertFileExists($file = COMMANDS_DIR . 'Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateController()
    {
        Buffer::callback(function()
        {
            new CreateController('Example');
        });

        $this->assertFileExists($file = CONTROLLERS_DIR . 'Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateModel()
    {
        Buffer::callback(function()
        {
            new CreateModel('Example1');
        });

        $this->assertFileExists($file = MODELS_DIR . 'Example1.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateGrandModel()
    {
        Buffer::callback(function()
        {
            new CreateGrandModel('Example');
        });

        $this->assertFileExists($file = MODELS_DIR . 'Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateGrandVision()
    {
        
    }

    public function testCreateMigration()
    {
        Buffer::callback(function()
        {
            new CreateMigration('Example', [0]);
        });

        $this->assertFileExists($file = MODELS_DIR . 'Migrations/Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateMigrationOtherVersion()
    {
        Buffer::callback(function()
        {
            new CreateMigration('Example', [2]);
        });

        $this->assertFileExists($file = MODELS_DIR . 'Migrations/ExampleVersion/002.php');

        if( is_dir($dir = MODELS_DIR . 'Migrations/ExampleVersion') )
        {
            Folder::delete($dir);
        }
    }

    public function testCreateProject()
    {
        $dir = PROJECTS_DIR . 'MyExampleProject';

        Buffer::callback(function()
        {
            new CreateProject('MyExampleProject');
        });

        $this->assertDirectoryExists($dir = PROJECTS_DIR . 'MyExampleProject');

        if( is_dir($dir) )
        {
            Folder::delete($dir);
        }
    }

    public function testCronSingleParameter()
    {
        $file = EXTERNAL_DIR . 'Crontab/Jobs';

        Buffer::callback(function()
        {
            new Cron('Example:run', ['daily']);
        });

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

        Buffer::callback(function()
        {
            new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);
        });

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

        Buffer::callback(function()
        {
            new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);
        });

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

        Buffer::callback(function()
        {
            new Cron('Example:run2', ['day', 'saturday', 'clock', '12:00']);
            new RemoveCron('Example');
        });

        $array = Crontab::listArray();

        $this->assertSame(0, count($array));
    }

    public function testDeleteCommand()
    {
        Buffer::callback(function()
        {
            new CreateCommand('Example');
            new DeleteCommand('Example');
        });

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

    public function testDeleteController()
    {
        Buffer::callback(function()
        {
            new CreateController('Example');
            new DeleteController('Example');
        });

        $file = CONTROLER_DIR . 'Example.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteGrandVision()
    {
        
    }

    public function testDeleteMigration()
    {
        Buffer::callback(function()
        {
            new CreateMigration('Example');
            new DeleteMigration('Example');
        });

        $file = MODELS_DIR . 'Migrations/Example.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteMigrationAll()
    {
        Buffer::callback(function()
        {
            new CreateMigration('Example');
            new DeleteMigrationAll();
        });

        $file = MODELS_DIR . 'Migrations/Example.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteModel()
    {
        Buffer::callback(function()
        {
            new CreateModel('Example');
            new DeleteModel('Example');
        });

        $file = MODELS_DIR . 'Example.php';

        if( is_file($file) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDeleteProject()
    {
        $dir = PROJECTS_DIR . 'MyExampleProject';

        Buffer::callback(function()
        {
            new CreateProject('MyExampleProject');
            new DeleteProject('MyExampleProject');
        });

        if( is_dir($dir) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testDownMigration()
    {
        
    }

    public function testUpMigration()
    {
        
    }

    public function testStartAndEndRestorationDelete()
    {
        $dir = PROJECTS_DIR . 'MERestore';

        Buffer::callback(function()
        {
            new CreateProject('ME');
            new StartRestoration('ME');
            new EndRestorationDelete('ME');
            new DeleteProject('ME');
        });

        if( is_dir($dir) )
        {
            $this->assertTrue(false);
        }
        else
        {
            $this->assertTrue(true);
        }
    }

    public function testRunButcher()
    {

    }

    public function testRunButcherDelete()
    {
        
    }

    public function testUndoUpgrade()
    {

    }

    public function testUpgrade()
    {

    }
}