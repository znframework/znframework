<?php namespace ZN\Generator;

use File;
use Generate;

class GrandVisionTest extends Test\GeneratorExtends
{
    public function testGrandVision()
    {
        Generate::grandVision();

        $this->assertFileExists($file = MODELS_DIR . 'Visions/UnitTests/package-database/testdb/InternalExampleVision.php');

        File::delete($file);
    }
}