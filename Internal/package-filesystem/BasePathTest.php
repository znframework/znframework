<?php namespace ZN\Filesystem;

use Folder;

class BasePathTest extends FilesystemExtends
{
    public function testBasePath()
    {
        $this->assertSame(getcwd(), Folder::basePath());
    }
}