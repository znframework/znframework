<?php namespace ZN\Filesystem;

use File;

class AppendFileTest extends FilesystemExtends
{
    public function testAppend()
    {
        File::write(self::file, 'test');

        File::append(self::file, ' example');

        $this->assertSame('test example', File::read(self::file));

        File::delete(self::file);
    }
}