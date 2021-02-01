<?php namespace ZN\Services;

use Buffer;
use Restful;

class ReturnTest extends \PHPUnit\Framework\TestCase
{
    public function testReturn()
    {
        $return = Buffer::callback(function()
        {
            Restful::contentType('json')->return(function()
            {
                echo json_encode(['example' => 'Example']);
            });
        });
        
        $this->assertJsonStringEqualsJsonString('{"example":"Example"}', $return);
    }
}