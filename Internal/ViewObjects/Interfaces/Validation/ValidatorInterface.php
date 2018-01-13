<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface ValidatorInterface
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
    public static function between(Float $value, Float $min, Float $max) : Bool;

   /**
     * Checks whether the grant is between the specified values.
     * 
     * @param float $value
     * @param float $min 
     * @param float $max
     * 
     * @return bool
     */
    public static function betweenBoth(Float $value, Float $min, Float $max) : Bool;

    /**
     * Checks whether the donation has phone information.
     * 
     * @param string $data
     * @param string $desing = NULL
     * 
     * @return bool
     */
    public static function phone(String $data, String $pattern = NULL) : Bool;

    /**
     * The data should be numeric.
     * 
     * @param mixed $data
     * 
     * @return bool
     */
    public static function numeric($data) : Bool;

    /**
     * Checks whether the verb is alphabetic.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function alnum(String $data) : Bool;

    /**
     * Controls whether the verb is alphanumeric.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function alpha(String $data) : Bool;

    /**
     * The citizenship identification number checks.
     * 
     * @param string $no 
     * 
     * @return bool
     */
    public static function identity($no) : Bool;

    /**
     * Checks whether the email is an e-mail.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function email(String $data) : Bool;

    /**
     * Checks whether the data is url.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function url(String $data) : Bool;

    /**
     * Checks whether the data is special char.
     * 
     * @param string $data
     * 
     * @return bool
     */
    public static function specialChar(String $data) : Bool;

    /**
     * Makes the maximum character limit.
     * 
     * @param string $data
     * @param int    $char
     * 
     * @return bool
     */
    public static function maxchar(String $data, Int $char) : Bool;

    /**
     * Makes the minimum character limit.
     * 
     * @param string $data
     * @param int    $char
     * 
     * @return bool
     */
    public static function minchar(String $data, Int $char) : Bool;
}
