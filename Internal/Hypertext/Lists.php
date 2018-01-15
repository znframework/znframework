<?php namespace ZN\Hypertext;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Hypertext\HtmlHelpersAbstract;
use ZN\DataTypes\Arrays;
use ZN\Base;
use ZN\IS;

class Lists extends HtmlHelpersAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(...$elements) : String
    {
        return $this->_element($elements[0], '', 0);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed   $data
    // @param string  $tab
    // @param numeric $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _element($data, $tab, $start)
    {
        static $start;

        $eof     = EOL;
        $output  = '';
        $attrs   = '';
        $tab     = str_repeat("\t", $start);

        if( ! is_array($data) )
        {
            return $data.$eof;
        }
        else
        {
            foreach( $data as $k => $v )
            {
                if( IS::realNumeric($k) )
                {
                    $value = $k;
                    $k     = 'li';
                }
                else
                {
                    $value = NULL;
                }

                $end = Base::prefix(Arrays\GetElement::first(explode(' ', $k)));

                if( ! is_array($v) )
                {

                    $output .= "$tab<$k>$v<$end>$eof";
                }
                else
                {
                    if( stripos($k, 'ul') !== 0 && stripos($k, 'ol') !== 0 && $k !== 'li' )
                    {
                        $value = $k;
                        $k     = 'li';
                        $end   = Base::prefix($k);
                    }
                    else
                    {
                        $value = NULL;
                    }

                    $output .= $tab."<$k>$value$eof".$this->_element($v, $tab, $start++).$tab."<$end>".$tab.$eof;
                    $start--;
                }
            }
        }

        return $output;
    }
}
