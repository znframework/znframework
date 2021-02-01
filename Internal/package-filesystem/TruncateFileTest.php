<?php namespace ZN\Filesystem;

use File;

class TruncateFileTest extends FilesystemExtends
{
    public function testTruncate()
    {
        File::write(self::file, 'example');
        
        File::truncate(self::file, 2);

        $this->assertSame('ex', File::read(self::file));

        File::delete(self::file);
    }
}