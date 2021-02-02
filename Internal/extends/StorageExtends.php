<?php namespace ZN\Storage;

use Config;

class StorageExtends extends \PHPUnit\Framework\TestCase
{
    public function __construct()
    {
        parent::__construct();

        Config::storage('cookie', ['encode' => 'md5']);
    }

    public function insert($key, $value)
    {
        $_COOKIE[md5($key)] = $value;

        return true;
    }

    public function __destruct()
    {
        parent::__construct();

        Config::storage('cookie', ['encode' => 'super']);
    }
}