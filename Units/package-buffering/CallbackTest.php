<?php namespace ZN\Buffering;

class CallbackTest extends \PHPUnit\Framework\TestCase
{
    public function testDo()
    {
        $callback = new Callback;

        $return = $callback->do(function($param)
        { 
            return $param; 

        }, [1]);

        $this->assertSame('1', $return);
    }
}