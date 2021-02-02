<?php namespace ZN\Generator;

use File;
use Generate;

class LibraryTest extends GeneratorExtends
{
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

        $this->assertFileExists($file = LIBRARIES_DIR . 'Example.php');

        File::delete($file);
    }
}