<?php namespace ZN\Ability;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;
use ZN\ErrorHandling\Exceptions;

trait Exclusion
{
    /**
     * Magic constructor
     * 
     * @param string $file    = NULL
     * @param string $message = NULL
     * @param mixed  $changed = NULL
     * 
     * @return void
     */
    public function __construct($file = NULL, $message = NULL, $changed = NULL)
    {
        if( defined('static::lang') && $file === NULL )
        {
            $file    = static::lang[Lang::get()] ?? 'No Exception Lang';
            $message = static::lang['placement'] ?? $message;

            if( is_array($message) )
            {
                $file = str_replace(array_keys($message), array_values($message), $file);
            }
            else
            {
                $file = str_replace('%', $message, $file);
            }
            
            $message = $file;
        }
        else
        {
            if( $data = Lang::select($file, $message, $changed) )
            {
                $message = $data;
            }
            elseif( is_object($file) )
            {
                $message = $file->getMessage();
            }
            else
            {
                $message = $file;
            }    
        }
       
        parent::__construct($message);
    }

    /**
     * Code continue
     * 
     * @param void
     * 
     * @return void
     */
    public function continue()
    {
        echo Exceptions::continue($this->getMessage(), $this->getFile(), $this->getLine());
    }
}