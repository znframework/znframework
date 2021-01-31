<?php namespace ZN\Request;

use Http;

class HttpIsAjaxTest extends \PHPUnit\Framework\TestCase
{
    public function testIsAjax()
    {
        $this->assertFalse(Http::isAjax());

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        $this->assertTrue(Http::isAjax());

        $_SERVER['HTTP_X_REQUESTED_WITH'] = NULL;
    }
}