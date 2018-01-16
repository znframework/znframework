<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception\InvalidArgumentException;

class Buffering
{
    /**
     * Buffer code
     * 
     * @param string $randomBufferClassCallbackCode
     * @param array  $randomBufferClassCallbackData
     * 
     * @return mixed
     */
    public static function code(String $randomBufferClassCallbackCode, Array $randomBufferClassCallbackData = NULL)
    {
        if( is_array($randomBufferClassCallbackData) )
        {
            extract($randomBufferClassCallbackData, EXTR_OVERWRITE, 'ZN');
        }

        ob_start();

        eval('?>' . $randomBufferClassCallbackCode);
       
        $randomBufferClassCallbackContents = ob_get_contents();
        
        ob_end_clean();

        return $randomBufferClassCallbackContents;
    }
    
    /**
     * Buffer file
     * 
     * @param string $randomBufferClassPagePath
     * @param array  $randomBufferClassDataVariable
     * 
     * @return string
     */
    public static function file(String $randomBufferClassPagePath, Array $randomBufferClassDataVariable = NULL) : String
    {
        if( ! is_file($randomBufferClassPagePath) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        if( is_array($randomBufferClassDataVariable) )
        {
            extract($randomBufferClassDataVariable, EXTR_OVERWRITE, 'ZN');
        }

        ob_start();

        require $randomBufferClassPagePath;

        $randomBufferClassPageContents = ob_get_contents();

        ob_end_clean();

        return $randomBufferClassPageContents;
    }
}
