<?php namespace ZN\Filesystem;

use File;
use Date;

class FileTest extends \PHPUnit\Framework\TestCase
{
    const directory = 'UnitTests/package-filesystem/resources/';
    const file      = self::directory . 'write-file.txt';

    public function testWrite()
    {
        File::write(self::file, 'test');

        $this->assertFileExists(self::file);
    }

    public function testRead()
    {
        $this->assertSame('test', File::read(self::file));
    }

    public function testFind()
    {
        $result = File::find(self::file, 'test');

        $this->assertSame(0, $result->index);
        $this->assertSame('test', $result->contents);
    }

    public function testCreate()
    {
        File::create($file = self::directory . 'create-file.txt');

        $this->assertFileExists($file);
    }

    public function testAppend()
    {
        File::append(self::file, ' example');

        $this->assertSame('test example', File::read(self::file));

        File::write(self::file, 'test');
    }

    public function testReplace()
    {
        File::replace(self::file, 'test', 'example');

        $this->assertSame('example', File::read(self::file));
    }

    public function testTruncate()
    {
        File::truncate(self::file, 2);

        $this->assertSame('ex', File::read(self::file));
    }

    public function testDelete()
    {
        File::delete(self::file);

        $this->assertFalse(is_file(self::file));

        File::write(self::file, 'test');
    }

    public function testRename()
    {
        File::rename(self::file, $file = self::directory . 'rename-file.txt');

        $this->assertFileExists($file);
    }

    public function testPermission()
    {
        File::create($file = self::directory . 'permission-file.txt');

        File::permission($file, 644);

        $this->assertSame(false, File::info($file)->executable);
    }

    public function testInfo()
    {
        File::rename($file = self::directory . 'rename-file.txt', self::file);

        $this->assertSame('write-file.txt', File::info(self::file)->basename);
    }

    public function testSize()
    {
        $this->assertSame(4, (int) File::size(self::file));
    }

    public function testCreateDate()
    {
        $this->assertSame('2021', Date::convert(File::createDate(self::file), 'Y'));
    }

    public function testChangeDate()
    {
        File::write(self::file, 'example');

        $this->assertSame('2021', Date::convert(File::changeDate(self::file), 'Y'));
    }

    public function testOwner()
    {
        File::owner(self::file);
    }

    public function testGroup()
    {
        File::group(self::file);
    }

    public function testCleanCache()
    {
        File::cleanCache();
    }

    public function testRowCount()
    {
        $this->assertSame(1, File::rowCount(self::file));
    }

    public function testCreateZip()
    {
        File::createZip($zipFile = self::directory . 'example.zip', [self::directory . 'create-file.txt', self::directory . 'write-file.txt']);

        $this->assertFileExists($zipFile);
    }

    public function testZipExtract()
    {
        File::zipExtract(self::directory . 'example.zip', self::directory . 'extract/');

        $this->assertDirectoryExists(self::directory . 'extract/');
    }

    public function testReadZip()
    {
        $zipFiles = File::readZip(self::directory . 'example.zip');

        $elements = 
        [
            self::directory . 'create-file.txt',
            self::directory . 'write-file.txt'
        ];

        $this->assertSame($elements, $zipFiles);
    }
}