<?php namespace ZN\Generator;

use Folder;
use Generate;

class GrandVisionTest extends GeneratorExtends
{
    public function testGrandVision()
    {
        Generate::grandVision();

        $this->assertFileExists(MODELS_DIR . 'Visions/' . self::default . 'package-database/testdb/InternalExampleVision.php');

        Folder::delete(MODELS_DIR . 'Visions/');
    }
}