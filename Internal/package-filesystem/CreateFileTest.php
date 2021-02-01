<?php namespace ZN\Filesystem;

use File;

class CreateFileTest extends FilesystemExtends
{
    public function testCreate()
    {
        File::create($file = self::directory . 'create-file.txt');

        $this->assertFileExists($file);
    }
}