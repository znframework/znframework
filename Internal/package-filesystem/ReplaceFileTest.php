<?php namespace ZN\Filesystem;

use File;

class ReplaceFileTest extends FilesystemExtends
{
    public function testReplace()
    {
        File::write(self::file, 'test');

        File::replace(self::file, 'test', 'example');

        $this->assertSame('example', File::read(self::file));

        File::delete(self::file);
    }
}