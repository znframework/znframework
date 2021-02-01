<?php namespace ZN\Filesystem;

use Folder;

class FolderTest extends \PHPUnit\Framework\TestCase
{
    const directory = 'UnitTests/package-filesystem/resources/';

    public function testCreate()
    {
        Folder::create($directory = self::directory . 'example');

        $this->assertDirectoryExists($directory);
    }

    public function testRename()
    {
        $return = Folder::rename(self::directory . 'example', self::directory . 'test');

        $this->assertIsBool($return);
    }

    public function testCopy()
    {
        $return = Folder::copy(self::directory . 'test', self::directory . 'default');

        $this->assertIsBool($return);
    }

    public function testBasePath()
    {
        $this->assertSame(getcwd(), Folder::basePath());
    }

    public function testGetFileInfo()
    {
        $this->assertIsArray((Folder::fileInfo(self::directory)));
    }

    public function testDisk()
    {
        $this->assertIsFloat(Folder::disk(self::directory));
        $this->assertIsFloat(Folder::disk(self::directory, 'total'));
    }

    public function testFiles()
    {
        $files     = Folder::files(self::directory);
        $someFiles = Folder::files(self::directory, ['txt']);

        $this->assertTrue(count($files) > count($someFiles));
    }

    public function testAllFiles()
    {
        $this->assertIsArray(Folder::allFiles(self::directory));
    }

    public function testPermission()
    {
        Folder::permission(self::directory . 'example', 0644);

        $this->assertIsBool(Folder::info(self::directory . 'example')->writable);
    }

    public function testDelete()
    {
        Folder::create($directory = self::directory . 'example2');

        $this->assertTrue(Folder::delete($directory));
    }

    public function testExists()
    {
        Folder::create($directory = self::directory . 'example3');

        $this->assertTrue(Folder::exists($directory));
    }
}