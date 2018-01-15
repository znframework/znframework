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

class Output
{
    /** 
     * Write
     * 
     * @param mixed $data = NULL
     * @param array $vars = NULL
     * 
     * @return void
     */
    public static function write($data = NULL, Array $vars = NULL)
    {
        if( ! is_scalar($data) )
        {
            echo 'Not String!'; return false;
        }

        if( ! empty($data) && is_array($vars) )
        {
            $varsArray = [];

            foreach( $vars as $k => $v )
            {
                $varsArray['{'.$k.'}']  = $v;
            }

            $data = str_replace(array_keys($varsArray), array_values($varsArray), $data);
        }

        echo $data;
    }

    /** 
     * Write Line
     * 
     * @param mixed $data    = NULL
     * @param array $vars    = NULL
     * @param int   $brCount = 1
     * 
     * @return void
     */
    public static function writeLine($data = NULL, Array $vars = NULL, Int $brCount = 1)
    {
        echo self::write($data, $vars) . str_repeat('<br>', $brCount);
    }

    /** 
     * Display
     * 
     * @param mixed $data    = NULL
     * @param array $vars    = NULL
     * @param bool  $content = false
     * 
     * @return void
     */
    public static function display($data, Array $settings = NULL, Bool $content = false)
    {
        $textType = $settings['textType'] ?? 'monospace, Tahoma, Arial';
        $textSize = $settings['textSize'] ?? '12px';

        $globalStyle = ' style="font-family:'.$textType.'; font-size:'.$textSize .';"';

        $output  = "<span$globalStyle>";
        $output .= self::_output($data, '', 0, (array) $settings);
        $output .= "</span>";

        if( $content === false)
        {
            echo $output;
        }
        else
        {
            return $output;
        }
    }

    /** 
     * Protected Output
     * 
     * @param mixed  $data
     * @param string $tab      = NULL
     * @param int    $start    = 0
     * @param array  $settings = []
     * 
     * @return void
     */
    protected static function _output($data, String $tab = NULL, Int $start = 0, Array $settings = []) : String
    {
        static $start;

        $lengthColor    = $settings['lengthColor']  ?? 'grey';
        $keyColor       = $settings['keyColor']     ?? '#000';
        $typeColor      = $settings['typeColor']    ?? '#8C2300';
        $stringColor    = $settings['stringColor']  ?? 'red';
        $numericColor   = $settings['numericColor'] ?? 'green';

        $output = '';
        $eof    = '<br>';
        $tab    = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $start);

        $lengthstyle = ' style="color:'.$lengthColor.'"';
        $keystyle    = ' style="color:'.$keyColor.'"';
        $typestyle   = ' style="color:'.$typeColor.'"';

        $vartype = 'array';

        if( is_object($data) )
        {
            $data = (array) $data;
            $vartype = 'object';
        }

        if( ! is_array($data) )
        {
            return $data.$eof;
        }
        else
        {
            foreach( $data as $k => $v )
            {
                if( is_object($v) )
                {
                    $v = (array) $v;
                    $vartype = 'object';
                }

                if( ! is_array($v) )
                {
                    $valstyle  = ' style="color:'.$numericColor.';"';

                    $type = gettype($v);

                    if( $type === 'string' )
                    {
                        $v = "'".$v."'";
                        $valstyle = ' style="color:'.$stringColor.';"';

                        $type = 'string';
                    }
                    elseif( $type === 'boolean' )
                    {
                        $v = ( $v === true ) ? 'true' : 'false';

                        $type = 'boolean';
                    }

                    $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$type</span> <span$valstyle>$v</span> <span$lengthstyle>( length = ".strlen($v)." )</span>$eof";
                }
                else
                {
                    $output .= "$tab<span$keystyle>$k</span> => <span$typestyle>$vartype</span> $eof $tab( $eof ".self::_output($v, $tab, (int) $start++)." $tab) ".$eof;
                    $start--;
                }
            }
        }

        return $output;
    }
}
