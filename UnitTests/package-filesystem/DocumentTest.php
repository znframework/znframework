<?php namespace ZN\Filesystem;

use Document;

class DocumentTest extends \PHPUnit\Framework\TestCase
{
    const directory = 'UnitTests/package-filesystem/resources/';

    public function testRun()
    {
        $this->assertSame
        (
            'Hello Body!',
            Document::target(self::directory . 'example.txt')
                    ->create()
                    ->write('Hello Body!')
                    ->read()
                    ->apply()
        );
    }
}