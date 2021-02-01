<?php namespace ZN\Filesystem;

use Document;

class DocumentTest extends FilesystemExtends
{
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