<?php namespace ZN\Filesystem;

use Folder;

class CopyFolderTest extends FilesystemExtends
{
    public function testCopy()
    {
        $return = Folder::copy(self::directory . 'test', self::directory . 'default');

        $this->assertIsBool($return);
    }
}