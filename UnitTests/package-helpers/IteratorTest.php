<?php namespace ZN\Helpers;

use Iterate;

class IteratorTest extends \PHPUnit\Framework\TestCase
{
    public function testArray()
    {
        $iterator = Iterate::array(['a', 'b', 'c']);

        $iterator->next();
        $iterator->next();

        $this->assertSame('c', $iterator->current());
    }

    public function testFilesystem()
    {
        $files = Iterate::filesystem('UnitTests/package-helpers');

        $this->assertSame('CleanerTest.php', $files->getFilename());
    }
}