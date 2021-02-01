<?php namespace ZN\Filesystem;

use File;

class FindFileTest extends FilesystemExtends
{
    public function testFind()
    {
        File::write(self::file, 'test');
        
        $result = File::find(self::file, 'test');

        $this->assertSame(0, $result->index);
        $this->assertSame('test', $result->contents);

        File::delete(self::file);
    }
}