<?php namespace ZN\Generator;

use File;
use Generate;

class SettingsTest extends GeneratorExtends
{
    public function testSettings()
    {
        Generate::settings
        ([ 
            'extends'    => 'GrandModel', 
            'constants'  => ['key' => '"value"'] 

        ])->model('Example2');

        $this->assertFileExists($file = MODELS_DIR . 'Example2.php');

        File::delete($file);
    }
}