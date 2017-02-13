<?php namespace ZN\IndividualStructures\User;

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
