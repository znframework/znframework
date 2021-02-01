<?php namespace ZN\Helpers;

use Searcher;

class SearcherTest extends \PHPUnit\Framework\TestCase
{
    public function testArrayData()
    {
        $this->assertSame(true, Searcher::data(['a', 'b'], 'b') );
        $this->assertSame(1, Searcher::data(['a', 'b'], 'b', 'position') );
        $this->assertSame('b', Searcher::data(['a', 'b'], 'b', 'string') );
    }

    public function testStringData()
    {
        $this->assertSame(true, Searcher::data('Example Data', 'Example') );
        $this->assertSame(0, Searcher::data('Example Data', 'Example', 'position') );
        $this->assertSame('Example Data', Searcher::data('Example Data', 'Example', 'string') ); 
    }
}