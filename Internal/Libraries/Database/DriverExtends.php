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

    protected $connect;

    public function __construct($settngs = [])
    {
        if( empty($settngs) )
        {
            $this->connect = new DB;
        }
        else
        {
            $this->connect = DB::differentConnection($settngs);
        }
    }
}
