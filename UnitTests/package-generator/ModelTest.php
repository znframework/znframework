<?php namespace ZN\Generator;

use Generate;

class ModelTest extends Test\GeneratorExtends
{
    public function testModel()
    {
        Generate::model('Example', 
        [
            'extends'    => 'GrandModel',
            'constants'  => ['key' => '"value"']
        ]);

        $this->assertFileExists(MODELS_DIR . 'Example.php');
    }
}