<?php namespace ZN\Database;

use DB;

class DriverExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    protected $differentConnection;
    protected $settings;

    public function __construct($settings = [])
    {
        $this->settings = $settings;
        $this->differentConnection = DB::differentConnection($settings);
    }
}
