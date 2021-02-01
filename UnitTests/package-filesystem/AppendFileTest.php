<?php namespace ZN\Filesystem;

use File;

class AppendFileTest extends FilesystemExtends
{
    public function testAppend()
    {
        File::append(self::file, ' example');

        $this->assertSame('test example', File::read(self::file));

        File::write(self::file, 'test');
    }
}