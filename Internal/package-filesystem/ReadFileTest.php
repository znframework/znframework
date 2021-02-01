<?php namespace ZN\Filesystem;

use File;

class ReadFileTest extends FilesystemExtends
{
    public function testRead()
    {
        File::write(self::file, 'test');
        
        $this->assertSame('test', File::read(self::file));

        File::delete(self::file);
    }
}