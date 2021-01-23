<?php namespace ZN\Comparison;

use File;
use Folder;
use Compress;

class CompressTest extends \PHPUnit\Framework\TestCase
{
    public function testZipExtract()
    {
        File::write('test.txt', 'test');

        File::createZip('example.zip', ['test.txt']);

        File::delete('test.txt');

        if( is_file('example.zip') )
        {
            $status = Compress::driver('zip')->extract('example.zip');

            $this->assertTrue($status);

            $this->assertFileExists('example.zip');

            Folder::delete('example');
            File::delete('example.zip');
        }
        else
        {
            $this->assertFalse(false);
        }
    }

    public function testWrite()
    {
        $status = Compress::write('example.txt', 'Example Data');

        $status ? $this->assertTrue($status) : $this->assertFalse($status);

        if( $status )
        {
            $this->assertFileExists('example.txt');

            File::delete('example.txt');
        }
    }

    public function testRead()
    {
        if( Compress::write('example.txt', 'Example Data') )
        {
            $read = Compress::read('example.txt');

            $this->assertSame('Example Data', $read);

            File::delete('example.txt');
        }
        else
        {
            $this->assertFalse(false);
        }
    }

    public function testDo()
    {
        $compress = Compress::do('Example Data');

        $this->assertIsString($compress);
    }

    public function testUndo()
    {
        $compress = Compress::do('Example Data');

        $undo = Compress::undo($compress);

        $this->assertIsString('Example Data', $undo);
    }
}