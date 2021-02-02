<?php namespace ZN\Generator;

use File;
use Generate;

class ModelTest extends GeneratorExtends
{
    public function testModel()
    {
        Generate::model('Example', 
        [
            'extends'    => 'GrandModel',
            'constants'  => ['key' => '"value"']
        ]);

        $this->assertFileExists($file = MODELS_DIR . 'Example.php');

        File::delete($file);
    }
}