<?php namespace ZN\IndividualStructures\User;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class UserExtends extends \CLController
{
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Multi Username Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string column
    // @param  mixed  $value
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _multiUsernameColumns($value)
    {
        $usernameColumns = INDIVIDUALSTRUCTURES_USER_CONFIG['matching']['columns']['otherLogin'];

        if( ! empty($usernameColumns) )
        {
            foreach( $usernameColumns as $column )
            {
                \DB::where($column, $value, 'or');
            }
        }
    }
}
