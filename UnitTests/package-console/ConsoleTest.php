<?php namespace ZN\Console;

use File;
use Cache;
use Folder;
use Buffer;
use Console;
use Crontab;

class ConsoleTest extends \PHPUnit\Framework\TestCase
{
    const COMMANDS_DIR    = 'Projects/Frontend/Commands/';
    const CONTROLLERS_DIR = 'Projects/Frontend/Controllers/';
    const MODELS_DIR      = 'Projects/Frontend/Models/';
    const PROJECTS_DIR    = 'Projects/';
    const EXTERNAL_DIR    = 'External/';

    public function testCleanCache()
    {
        Cache::insert('a', 'value');

        Buffer::callback(function()
        {
            new CleanCache;

            if( $value = Cache::select('a') )
            {
                $this->assertTrue('value', $value);
            }
            else
            {
                $this->assertEmpty($value);
            }
        });
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

        $this->assertFileExists($file = self::COMMANDS_DIR . 'Example.php');

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

        $this->assertFileExists($file = self::CONTROLLERS_DIR . 'Example.php');

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

        $this->assertFileExists($file = self::MODELS_DIR . 'Example1.php');

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

        $this->assertFileExists($file = self::MODELS_DIR . 'Example.php');

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
        return;

        Buffer::callback(function()
        {
            new CreateMigration('Example', [0]);
        });

        $this->assertFileExists($file = self::MODELS_DIR . 'Migrations/Example.php');

        if( is_file($file) )
        {
            File::delete($file);
        }
    }

    public function testCreateMigrationOtherVersion()
    {
        return;

        Buffer::callback(function()
        {
            new CreateMigration('Example', [2]);
        });

        $this->assertFileExists($file = self::MODELS_DIR . 'Migrations/ExampleVersion/002.php');

        if( is_dir($dir = self::MODELS_DIR . 'Migrations/ExampleVersion') )
        {
            Folder::delete($dir);
        }
    }

    public function testCreateProject()
    {
        $dir = self::PROJECTS_DIR . 'MyExampleProject';

        Buffer::callback(function()
        {
            new CreateProject('MyExampleProject');
        });

        $this->assertDirectoryExists($dir = self::PROJECTS_DIR . 'MyExampleProject');

        if( is_dir($dir) )
        {
            Folder::delete($dir);
        }
    }

    public function testCronSingleParameter()
    {
        $file = self::EXTERNAL_DIR . 'Crontab/Jobs';

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
        $file = self::EXTERNAL_DIR . 'Crontab/Jobs';

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
        $file = self::EXTERNAL_DIR . 'Crontab/Jobs';

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
        $file = self::EXTERNAL_DIR . 'Crontab/Jobs';

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

        $file = self::COMMANDS_DIR . 'Example.php';

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

        $file = self::CONTROLLERS_DIR . 'Example.php';

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
        return;

        Buffer::callback(function()
        {
            new CreateMigration('Example');
            new DeleteMigration('Example');
        });

        $file = self::MODELS_DIR . 'Migrations/Example.php';

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
        return;

        Buffer::callback(function()
        {
            new CreateMigration('Example');
            new DeleteMigrationAll();
        });

        $file = self::MODELS_DIR . 'Migrations/Example.php';

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

        $file = self::MODELS_DIR . 'Example.php';

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
        $dir = self::PROJECTS_DIR . 'MyExampleProject';

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
        $dir = self::PROJECTS_DIR . 'MERestore';

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