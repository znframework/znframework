<?php namespace ZN\Request;

use URL;

class URLBuildQueryTest extends \PHPUnit\Framework\TestCase
{
    public function testUrlBuildQuery()
    {
        $data =
        [
            'foo'=>'bar',
            'baz'=>'boom',
            'cow'=>'milk',
            'php'=>'hypertext processor'
        ];

        $this->assertEquals('foo=bar&baz=boom&cow=milk&php=hypertext+processor', URL::buildQuery($data));
    }

    public function testUrlBuildQueryWithPrefixParameter()
    {
        $data =
        [
            'bar',
            'foo' => 'foo',
            'baz'
        ];

        $this->assertEquals('prefix_0=bar&foo=foo&prefix_1=baz', URL::buildQuery($data, 'prefix_'));
    }

    public function testUrlBuildQueryWithSeparatorParameter()
    {
        $data =
        [
            'foo' => 'foo',
            'baz' => 'baz'
        ];

        $this->assertEquals('foo=foo|baz=baz', URL::buildQuery($data, '', '|'));
    }

    public function testUrlBuildQueryWithEnctypeParameter()
    {
        $data =
        [
            'foo'=>'bar',
            'baz'=>'boom',
            'cow'=>'milk',
            'php'=>'hypertext processor'
        ];

        $this->assertEquals('foo=bar&baz=boom&cow=milk&php=hypertext%20processor', URL::buildQuery($data, '', '&', '%'));
    }
}