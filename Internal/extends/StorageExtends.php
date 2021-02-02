<?php namespace ZN\Storage;

use Config;

class StorageExtends extends \ZN\Test\GlobalExtends
{
    public function __construct()
    {
        parent::__construct();

        Config::storage('cookie', ['encode' => 'md5']);
    }

    public function insert($key, $value, $hash = 'md5')
    {
        $_COOKIE[$hash($key)] = $value;

        return true;
    }

    public function __destruct()
    {
        parent::__construct();

        Config::storage('cookie', ['encode' => 'super']);
    }
}