<?php namespace ZN\IndividualStructures\User;

use DB;

class UserExtends extends \CLController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'IndividualStructures:user';

    public function __construct()
    {
        parent::__construct();

        if( ! empty(INDIVIDUALSTRUCTURES_USER_CONFIG['staticConnection']) )
        {
            Properties::$connection = DB::differentConnection(INDIVIDUALSTRUCTURES_USER_CONFIG['staticConnection']);
        }
        else
        {
            Properties::$connection = new DB;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string column
    // @param  mixed  $value
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function column(String $column, $value) : UserExtends
    {
        Properties::$parameters['column'][$column] = $value;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Return Link
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $returnLink
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function returnLink(String $returnLink) : UserExtends
    {
        Properties::$parameters['returnLink'] = $returnLink;

        return $this;
    }
}
