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

interface CalendarInterface
{
    /**
     * Specifies the URL to use.
     * 
     * @param string $url
     * 
     * @return Calendar
     */
    public function url(String $url) : Calendar;

    /**
     * Specifies the name to be displayed.
     * 
     * @param string $day   - options[long|short]
     * @param string $month - options[long|short]
     * 
     * @return Calendar
     */
    public function nameType(String $day, String $month) : Calendar;

    /**
     * Specifies the css values.
     * 
     * @param array $css
     * 
     * @return Calendar
     */
    public function css(Array $css) : Calendar;

    /**
     * Specifies the style values.
     * 
     * @param array $style
     * 
     * @return Calendar
     */
    public function style(Array $style) : Calendar;

    /**
     * Specifies the type of calendar.
     * 
     * @param string $type - options[classic|ajax]
     * 
     * @return Calendar
     */
    public function type(String $type) : Calendar;

    /**
     * Change button names.
     * 
     * @param string $prev
     * @param string $next
     * 
     * @return Calendar
     */
    public function linkNames(String $prev, String $next) : Calendar;

    /**
     * Configures all settings.
     * 
     * @param array $settings
     * 
     * @return Calendar
     */
    public function settings(Array $settings) : Calendar;

    /**
     * Complete the calendar creation process.
     * 
     * @param int $year  = NULL
     * @param int $month = NULL
     * 
     * @return string
     */
    public function create(Int $year = NULL, Int $month = NULL) : String;
}
