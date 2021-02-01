<?php namespace ZN\Filesystem;

use File;

class DeleteFileTest extends FilesystemExtends
{
    public function testDelete()
    {
        File::write(self::file, 'test');
        
        File::delete(self::file);

        $this->assertFalse(is_file(self::file));

        File::write(self::file, 'test');
    }
}