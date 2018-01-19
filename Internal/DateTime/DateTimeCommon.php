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

use ZN\Config;
use ZN\Datatype;

class DateTimeCommon
{
    /**
     * Keeps datetime config.
     * 
     * @var array
     */
    protected $config;

    /**
     * Keeps Class Name
     * 
     * @var string
     */
    protected $className = 'ZN\DateTime\Date';

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->config = Config::default(new DateTimeDefaultConfiguration)::get('Project');

        setlocale(LC_ALL, $this->config['locale']['charset'], $this->config['locale']['language']);
    }

    /**
     * Compare dates
     * 
     * @param string $value1
     * @param string $condition
     * @param string $value2
     * 
     * @return bool
     */
    public function compare(String $value1, String $condition, String $value2) : Bool
    {
        $value1 = $this->toNumeric($value1);
        $value2 = $this->toNumeric($value2);
        
        return version_compare($value1, $value2, $condition);
    }

    /**
     * Turns historical data into numeric data.
     * 
     * @param string $dateFormat
     * @param int    $now = NULL
     * 
     * @return int
     */
    public function toNumeric(String $dateFormat, Int $now = NULL) : Int
    {
        if( $now === NULL )
        {
            $now = time();
        }

        return strtotime($this->_datetime($dateFormat), $now);
    }

    /**
     * Converts time data to readable form.
     * 
     * @param int $time
     * @param string $dateFormat = 'Y-m-d H:i:s'
     * 
     * @return string
     */
    public function toReadable(Int $time, String $dateFormat = 'Y-m-d H:i:s') : String
    {
        return $this->_datetime($dateFormat, $time);
    }

    /**
     * Calculates between dates.
     * 
     * @param string $input
     * @param string $calculate
     * @param string $output = 'Y-m-d'
     * 
     * @return string
     */
    public function calculate(String $input, String $calculate, String $output = 'Y-m-d') : String
    {
        if( ! preg_match('/^[0-9]/', $input) )
        {
            $input = $this->_datetime($input);
        }

        # 5.3.5[added]
        if( $this->_classname() === 'ZN\DateTime\Time' && $output === 'Y-m-d' )
        {
            $output = '{Hour}:{minute}:{second}';
        }

        $output = $this->_convert($output);

        return $this->_datetime($output, strtotime($calculate, strtotime($input)));
    }

    /**
     * Sets the date and time.
     * 
     * @param string $exp 
     * 
     * @return string
     */
    public function set(String $exp) : String
    {
        return $this->_datetime($exp);
    }

    /**
     * Protected Convert
     */
    protected function _convert($change)
    {
        $config = $this->_chartype();

        $chars  = Properties::${$config};

        $chars  = Datatype::multikey($chars);

        return str_ireplace(array_keys($chars), array_values($chars), $change);
    }

    /**
     * Protected Class Name
     */
    protected function _classname()
    {
        return $className = get_called_class();
    }

    /**
     * Protected Date Time
     */
    protected function _datetime($format, $timestamp = NULL)
    {
        if( $timestamp === NULL )
        {
            $timestamp = time();
        }

        $className = $this->_classname();

        $func = $className === $this->className ? 'date' : 'strftime';

        return $func($this->_convert($format), $timestamp);
    }

    /**
     * Protected Chartype
     */
    protected function _chartype()
    {
        $className = $this->_classname();

        return $className === $this->className ? 'setDateFormatChars' : 'setTimeFormatChars';
    }
}
