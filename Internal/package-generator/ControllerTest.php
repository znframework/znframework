<?php namespace ZN\Generator;

use File;
use Generate;

class ControllerTest extends GeneratorExtends
{
    public function testController()
    {
        Generate::controller('Example', 
        [
            'extends'    => 'Controller',
            'functions'  => ['main', 'test']
        ]);

        $this->assertFileExists($file = CONTROLLERS_DIR . 'Example.php');

        File::delete($file);
    }
}