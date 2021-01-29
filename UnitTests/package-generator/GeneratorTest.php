<?php namespace ZN\Generator;

use File;
use Generate;

class GeneratorTest extends Test\Constructor
{
    public function testDatabase()
    {
        $this->assertNull(Generate::databases());
    }

    public function testController()
    {
        Generate::controller('Example', 
        [
            'extends'    => 'Controller',
            'functions'  => ['main', 'test']
        ]);

        $this->assertFileExists(CONTROLLERS_DIR . 'Example.php');
    }

    public function testModel()
    {
        Generate::model('Example', 
        [
            'extends'    => 'GrandModel',
            'constants'  => ['key' => '"value"']
        ]);

        $this->assertFileExists(MODELS_DIR . 'Example.php');
    }

    public function testLibrary()
    {
        Generate::library('Example', 
        [
            'implements' => 'TestLibInterface',
            'extends'    => 'Controller',
            'namespace'  => 'TestExample',
            'use'        => ['Folder', 'File' => 'F'],
            'functions'  => ['main', 'test' => ['a', 'int b' => '10', 'c', 'string ...args']],
            'constants'  => ['TEST' => '"Test"', 'NUM' => '10'],
            'traits'     => ['abc', 'xxx'],
            'vars'       => ['protected:test' => '10', 'examples', 'test2' => '"Test"' ]
        ]);

        $this->assertFileExists(LIBRARIES_DIR . 'Example.php');
    }

    public function testSettings()
    {
        Generate::settings
        ([ 
            'extends'    => 'GrandModel', 
            'constants'  => ['key' => '"value"'] 

        ])->model('Example2');

        $this->assertFileExists(MODELS_DIR . 'Example2.php');
    }

    public function testGrandVision()
    {
        Generate::grandVision();

        $this->assertFileExists($file = MODELS_DIR . 'Visions/UnitTests/package-database/testdb/InternalExampleVision.php');

        File::delete($file);
    }
}