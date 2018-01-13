<?php namespace ZN\Validation;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IS;

class Validator implements ValidatorInterface
{
    /**
     * Checks whether the grant is between the specified values.
     * 
     * @param float $value
     * @param float $min 
     * @param float $max
     * 
     * @return bool
     */
    public static function between(Float $value, Float $min, Float $max) : Bool
    {
        return self::betweenBoth($value, $min, $max, 'noboth');
    }

    /**
     * Checks whether the grant is between the specified values.
     * 
     * @param float $value
     * @param float $min 
     * @param float $max
     * 
     * @return bool
     */
    public static function betweenBoth(Float $value, Float $min, Float $max, $type = 'both') : Bool
    {
        if( $min > $max )
        {
            $mmin = $min;
            $min  = $max;
            $max  = $mmin;
        }

        if( $type === 'both' )
        {
            return $value >= $min && $value <= $max;
        }

        return $value > $min && $value < $max;
    }

    /**
     * Checks whether the donation has phone information.
     * 
     * @param string $data
     * @param string $desing = NULL
     * 
     * @return bool
     */
    public static function phone(String $data, String $pattern = NULL) : Bool
    {
        if( $pattern !== NULL)
        {
            $phoneData = preg_replace('/([^\*])/', 'key:$1', $pattern);
            $phoneData = '/'.str_replace(['*', 'key:'], ['[0-9]', '\\'], $phoneData).'/';
        }
        else
        {
            $phoneData = '/\+*[0-9]{10,14}$/';
        }

        return (bool) preg_match($phoneData, $data);
    }

    /**
     * The data should be numeric.
     * 
     * @param mixed $data
     * 
     * @return bool
     */
    public static function numeric($data) : Bool
    {
        return is_numeric($data);
    }

    /**
     * Checks whether the verb is alphabetic.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function alnum(String $data) : Bool
    {
        return (bool) preg_match('/^\w+$/', $data);
    }

    /**
     * Controls whether the verb is alphanumeric.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function alpha(String $data) : Bool
    {
        return ctype_alpha($data);
    }

    /**
     * The citizenship identification number checks.
     * 
     * @param string $no 
     * 
     * @return bool
     */
    public static function identity($no) : Bool
    {
        if( ! is_numeric($no) || strlen($no) !== 11  )
        {
            return false;
        }

        $no = (string) $no;

        $numone     = ($no[0] + $no[2] + $no[4] + $no[6]  + $no[8]) * 7;
        $numtwo     = $no[1] + $no[3] + $no[5] + $no[7];
        $result     = $numone - $numtwo;
        $tenth      = $result % 10;
        $total      = ($no[0] + $no[1] + $no[2] + $no[3] + $no[4] + $no[5] + $no[6] + $no[7] + $no[8] + $no[9]);
        $elewenth   = $total % 10;

        if( $no[0] == 0 )
        {
            return false;
        }
        elseif( $no[9] != $tenth )
        {
            return false;
        }
        elseif( $no[10] != $elewenth )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Checks whether the email is an e-mail.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function email(String $data) : Bool
    {
        return IS::email($data);
    }

    /**
     * Checks whether the data is url.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function url(String $data) : Bool
    {
        return IS::url($data);
    }

    /**
     * Checks whether the data is special char.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function specialChar(String $data) : Bool
    {
        return (bool) preg_match('/[\W]+/', $data);
    }

    /**
     * Makes the maximum character limit.
     * 
     * @param string $data
     * @param int    $char
     * 
     * @return bool
     */
    public static function maxchar(String $data, Int $char) : Bool
    {
        return ( strlen($data) <= $char );
    }

    /**
     * Makes the minimum character limit.
     * 
     * @param string $data
     * @param int    $char
     * 
     * @return bool
     */
    public static function minchar(String $data, Int $char) : Bool
    {
        return ( strlen($data) >= $char );
    }
}
