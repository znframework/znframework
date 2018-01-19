<?php namespace ZN\DateTime;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface DateTimeCommonInterface
{
    /**
     * Compare dates
     * 
     * @param string $value1
     * @param string $condition
     * @param string $value2
     * 
     * @return bool
     */
    public function compare(String $value1, String $condition, String $value2) : Bool;

    /**
     * Turns historical data into numeric data.
     * 
     * @param string $dateFormat
     * @param int    $now = NULL
     * 
     * @return int
     */
    public function toNumeric(String $dateFormat, Int $now = NULL) : Int;

     /**
     * Converts time data to readable form.
     * 
     * @param int $time
     * @param string $dateFormat = 'Y-m-d H:i:s'
     * 
     * @return string
     */
    public function toReadable(Int $time, String $dateFormat = 'Y-m-d H:i:s') : String;

    /**
     * Calculates between dates.
     * 
     * @param string $input
     * @param string $calculate
     * @param string $output = 'Y-m-d'
     * 
     * @return string
     */
    public function calculate(String $input, String $calculate, String $output = 'Y-m-d') : String;

    /**
     * Sets the date and time.
     * 
     * @param string $exp 
     * 
     * @return string
     */
    public function set(String $exp) : String;

    /**
     * Gives the active time information.
     * 
     * @param string $clock
     * 
     * @return string
     */
    public function current(String $clock) : String;

    /**
     * Converts date information.
     * 
     * @param string $date
     * @param string $format
     * 
     * @return string
     */
    public function convert(String $date, String $format) : String;

    /**
     * Generates standard date and time information.
     * 
     * @return string
     */
    public function standart() : String;
}
