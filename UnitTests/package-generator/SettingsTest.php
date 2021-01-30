<?php namespace ZN\Generator;

use Generate;

class SettingsTest extends Test\GeneratorExtends
{
    public function testSettings()
    {
        Generate::settings
        ([ 
            'extends'    => 'GrandModel', 
            'constants'  => ['key' => '"value"'] 

        ])->model('Example2');

        $this->assertFileExists(MODELS_DIR . 'Example2.php');
    }
}